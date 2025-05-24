<?php

namespace App\Http\Controllers;

use App\Exceptions\NexusException;
use App\Http\Resources\ExamResource;
use App\Http\Resources\UserResource;
use App\Models\LoginLog;
use App\Models\PersonalAccessTokenPlain;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\AuthenticateRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use Nexus\Database\NexusDB;

class AuthenticateController extends Controller
{
    private $repository;

    public function __construct(AuthenticateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $result = $this->repository->login($request->username, $request->password);
        $includes = explode(',', $request->get('include', ''));
        if (in_array('site_info', $includes)) {
            $basic = Setting::get('basic');
            $result['site_info'] = [
                'site_name' => $basic['SITENAME'],
            ];
        }
        return $this->success($result);
    }

    public function logout(Request $request)
    {
        $result = $this->repository->logout(Auth::id());
        return $this->success($result);
    }

    public function passkeyLogin($passkey)
    {
        $deadline = Setting::get('security.login_secret_deadline');
        if ($deadline && $deadline > now()->toDateTimeString()) {
            $user = User::query()->where('passkey', $passkey)->first(['id', 'passhash', 'secret', 'auth_key']);
            if ($user) {
                $ip = getip();
                logincookie($user->id, $user->auth_key);
                $user->last_login = now();
                $user->save();
                $userRep = new UserRepository();
                $userRep->saveLoginLog($user->id, $ip, 'Passkey', false);
            }
        }
        return redirect('index.php');
    }

    public function nasToolsApprove(Request $request)
    {
        $request->validate([
            'data' => 'required|string'
        ]);
        try {
            $user = $this->repository->nasToolsApprove($request->data);
            $resource = new UserResource($user);
            //temporarily compatible
            return $this->success($this->polyfillArray($resource, $request), "Please use data.data");
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            $params = $request->all();
            do_log(sprintf("nasToolsApprove fail: %s, params: %s", $msg, nexus_json_encode($params)));
            return $this->fail($params, $msg);
        }
    }

    private function polyfillArray(JsonResource $resource, Request $request)
    {
        $data = $resource->response($request)->getData(true)['data'];
        $result = $data;
        $result['data'] = $data;
        return $result;
    }

    public function iyuuApprove(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
                'id' => 'required|integer',
                'verity' => 'required|string',
                'provider' => ["required", "string", Rule::in("iyuu")],
            ]);
            $this->repository->iyuuApprove($request->token, $request->id, $request->verity);
            return response()->json(["success" => true]);
        } catch (\Exception $exception) {
            return response()->json(["success" => false, "msg" => $exception->getMessage()]);
        }
    }

    public function ammdsApprove(Request $request)
    {
        try {
            $request->validate([
                'uid' => 'required|integer',
                'timestamp' => 'required|integer',
                'nonce' => 'required|string',
                'signature' => 'required|string',
            ]);
            $user = $this->repository->ammdsApprove($request);
            $resource = new UserResource($user);
            //temporarily compatible
            return $this->success($this->polyfillArray($resource, $request), "Please use data.data");
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            $params = $request->all();
            do_log(sprintf("ammdsApprove fail: %s, params: %s", $msg, nexus_json_encode($params)));
            return $this->fail($params, $msg);
        }
    }

    public function challenge(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
            ]);
            $username = $request->username;
            $challenge = mksecret();
            NexusDB::cache_put(get_challenge_key($username), $challenge,300);
            $user = User::query()->where("username", $username)->first(['secret']);
            return $this->success([
                "challenge" => $challenge,
                'secret' => $user->secret ?? mksecret(),
            ]);
        } catch (\Exception $exception) {
            $msg = $exception->getMessage();
            $params = $request->all();
            do_log(sprintf("challenge fail: %s, params: %s", $msg, nexus_json_encode($params)));
            return $this->fail($params, $msg);
        }
    }





}
