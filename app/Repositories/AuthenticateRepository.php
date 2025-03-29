<?php
namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\UnauthorizedException;

class AuthenticateRepository extends BaseRepository
{
    public function login($username, $password)
    {
        $user = User::query()
            ->where('username', $username)
            ->first(array_merge(User::$commonFields, ['class', 'secret', 'passhash']));
        if (!$user || md5($user->secret . $password . $user->secret) != $user->passhash) {
            throw new \InvalidArgumentException('Username or password invalid.');
        }
//        if (nexus()->isPlatformAdmin() && !$user->canAccessAdmin()) {
//            throw new UnauthorizedException('Unauthorized!');
//        }
        $user->checkIsNormal();
        $tokenName = __METHOD__ . __LINE__;
        $token = DB::transaction(function () use ($user, $tokenName) {
            $user->update(['last_login' => Carbon::now()]);
            $tokenResult = $user->createToken($tokenName);
            return $tokenResult->plainTextToken;
        });
        $result = (new UserResource($user))->response()->getData(true)['data'];
        $result['token'] = $token;
        return $result;
    }

    public function logout($id)
    {
        $user = User::query()->findOrFail($id, ['id']);
        $result = $user->tokens()->delete();
        return $result;
    }

    public function nasToolsApprove(string $json)
    {
        $key = config('nexus.nas_tools_key');
        $encrypter = new Encrypter($key);
        $decrypted = $encrypter->decryptString($json);
        $data = json_decode($decrypted, true);
        if (!is_array($data) || !isset($data['uid'], $data['passkey'])) {
            throw new \InvalidArgumentException("Invalid data format.");
        }
        $user = User::query()
            ->where('id', $data['uid'])
            ->where('passkey', $data['passkey'])
            ->first()
        ;
        if (!$user) {
            throw new \InvalidArgumentException("Invalid uid or passkey.");
        }
        $user->checkIsNormal();
        return $user;
    }

    public function iyuuApprove($token, $id, $verity)
    {
        $secret = config('nexus.iyuu_secret');
        $user = User::query()->findOrFail($id, User::$commonFields);
        $user->checkIsNormal();
        $encryptedResult = md5($token . $id . sha1($user->passkey) . $secret);
        if ($encryptedResult != $verity) {
            throw new \InvalidArgumentException("Invalid uid or passkey");
        }
        return true;
    }

    public function ammdsApprove(Request $request)
    {
        $now = Carbon::now();
        if (abs($now->getTimestampMs() - $request->timestamp) > 300 * 1000) {
            throw new \InvalidArgumentException("expired.");
        }
        $cacheKey = sprintf("ammdsApprove:%s", $request->nonce);
        if (Cache::has($cacheKey)) {
            throw new \InvalidArgumentException("duplicate.");
        }
        Cache::put($cacheKey, 1, 600);
        $user = User::query()->findOrFail($request->uid, User::$commonFields);
        $user->checkIsNormal();
        $passkeyHash = hash('sha256', $user->passkey);
        $dataToSign = sprintf("%s%s%s%s", $user->id, $passkeyHash, $request->timestamp, $request->nonce);
        $signatureKey = config('nexus.ammds_secret');
        $serverSignature = hash_hmac('sha256', $dataToSign, $signatureKey);
        if (!hash_equals($serverSignature, $request->signature)) {
            do_log(sprintf(
                "uid: %s, passkey_hash: %s, timestamp: %s, nonce: %s, dataToSign: %s, signatureKey: %s, serverSignature: %s, requestSignature: %s, !hash_equals",
                $user->id, $passkeyHash, $request->timestamp, $request->nonce, $dataToSign, $signatureKey, $serverSignature, $request->signature
            ));
            throw new \InvalidArgumentException("Invalid signature.");
        }
        return $user;
    }
}
