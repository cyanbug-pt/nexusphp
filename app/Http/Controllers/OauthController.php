<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\OauthClient;
use App\Models\OauthProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

class OauthController extends Controller
{
    /**
     * client redirect to authorization server, use oauth_providers config
     *
     * @param Request $request
     * @param string $uuid
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Request $request, string $uuid)
    {
        $provider = OauthProvider::query()->where('uuid', $uuid)->firstOrFail();
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => $provider->client_id,
            'redirect_uri' => $provider->redirect,
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
//            'prompt' => 'none', // "none", "consent", or "login"
        ]);
        $authorizationUrl = sprintf(
            '%s%s%s',
            $provider->authorization_endpoint_url,
            str_contains($provider->authorization_endpoint_url, '?') ? '&' : '?',
            $query
        );
        return redirect($authorizationUrl);

    }

    /**
     * authorization server redirect to this url with auth code after user authorized
     * and then use auth code to request to authorization server token endpoint url to get access token
     *
     * @param Request $request
     * @param string $uuid
     * @return array|mixed
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Throwable
     */
    public function callback(Request $request, string $uuid)
    {
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            \InvalidArgumentException::class
        );

        $provider = OauthProvider::query()->where('uuid', $uuid)->firstOrFail();

        $response = Http::asForm()->post($provider->token_endpoint_url, [
            'grant_type' => 'authorization_code',
            'client_id' => $provider->client_id,
            'client_secret' => $provider->client_secret,
//            'redirect_uri' => url("oauth/login"),
            'code' => $request->code,
        ]);
        $tokenInfo = $response->json();
        do_log("tokenInfo: " . $response->body());
        //use token get user-info
        $response = Http::withToken($tokenInfo['access_token'])->get($provider->user_info_endpoint_url);
        $userInfo = $response->json();
        do_log("userInfo: " . $response->body());
        $userId = data_get($userInfo, $provider->id_claim);
        $username = data_get($userInfo, $provider->username_claim);
        $email = data_get($userInfo, $provider->email_claim);
        dd($userInfo, $userId, $username, $email);
    }

    public function debug(Request $request)
    {
        dd($request->all());
    }


    public function userInfo(): array
    {
        $user = Auth::user();
        $resource = new UserResource($user);
        return $resource->response()->getData(true)['data'];
    }
}
