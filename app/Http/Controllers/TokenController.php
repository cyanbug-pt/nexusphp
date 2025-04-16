<?php

namespace App\Http\Controllers;

use App\Exceptions\NexusException;
use App\Models\PersonalAccessTokenPlain;
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
            $newAccessToken = $user->createToken($request->name, $request->permissions);
            $tokenText = $newAccessToken->plainTextToken;
            $msg = nexus_trans("token.create_success_tip", ['token' => $tokenText]);
            return $this->successJsonResource(['token' => $tokenText], $msg);
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

    public function getPlainText(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer',
            ]);
            $user = Auth::user();
            $token = $user->tokens()->where("id", $request->id)->first();
            if (!$token) {
                throw new NexusException("Token not found");
            }
            $plainRecord = PersonalAccessTokenPlain::query()->where("access_token_id", $token->id)->first();
            if (!$plainRecord) {
                throw new NexusException("Plain record not found");
            }
            return $this->success($plainRecord->plain_text_token);
        } catch (\Exception $exception) {
            return $this->fail(false, $exception->getMessage());
        }
    }




}
