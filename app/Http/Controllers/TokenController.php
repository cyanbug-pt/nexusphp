<?php

namespace App\Http\Controllers;

use App\Exceptions\NexusException;
use App\Repositories\TokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    private $repository;

    public function __construct(TokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addToken(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'permissions' => 'required|array|min:1',
            ]);
            $user = Auth::user();
            $count = $user->tokens()->count();
            if ($count >= 5) {
                throw new NexusException(nexus_trans("token.maximum_allow_number_reached"));
            }
            $allowed = TokenRepository::listUserTokenPermissionAllowed();
            foreach ($request->permissions as $permission) {
                if (!isset($allowed[$permission])) {
                    throw new NexusException(nexus_trans("token.permission_not_allowed", ['permission_text' => nexus_trans("route-permission.{$permission}.text")]));
                }
            }
            $newAccessToken = $user->createToken($request->name, $request->permissions);
            $tokenText = $newAccessToken->plainTextToken;
            $msg = nexus_trans("token.create_success_tip", ['token' => $tokenText]);
            return $this->success(['token' => $tokenText], $msg);
        } catch (\Exception $exception) {
            return $this->fail(false, $exception->getMessage());
        }
    }

    public function delToken(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer',
            ]);
            $user = Auth::user();
            $user->tokens()->where("id", $request->id)->delete();
            return $this->success(true);
        } catch (\Exception $exception) {
            return $this->fail(false, $exception->getMessage());
        }
    }


}
