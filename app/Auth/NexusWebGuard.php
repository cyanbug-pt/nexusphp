<?php
namespace App\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NexusWebGuard implements StatefulGuard
{
    use GuardHelpers;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new authentication guard.
     *
     * @param  callable  $callback
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Auth\UserProvider|null  $provider
     * @return void
     */
    public function __construct(Request $request, UserProvider $provider = null)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (! is_null($this->user)) {
            return $this->user;
        }
        $credentials = $this->request->cookie();
        if ($this->validate($credentials)) {
            /**
             * @var User $user
             */
            $user = $this->provider->retrieveByCredentials($credentials);
            if (empty($user)) {
                return null;
            }
            if ($this->provider->validateCredentials($user, $credentials)) {
                $user->checkIsNormal();
                return $this->user = $user;
            }
        }
    }


    /**
     * Validate a user's credentials.
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $required = ['c_secure_pass'];
        foreach ($required as $value) {
            if (empty($credentials[$value])) {
                return false;
            }
        }
        return true;
    }

    public function logout()
    {
        logoutcookie();
        return nexus_redirect('login.php');
    }


    public function attempt(array $credentials = [], $remember = false)
    {
        // TODO: Implement attempt() method.
    }

    public function once(array $credentials = [])
    {
        // TODO: Implement once() method.
    }

    public function login(Authenticatable $user, $remember = false)
    {
        // TODO: Implement login() method.
    }

    public function loginUsingId($id, $remember = false)
    {
        // TODO: Implement loginUsingId() method.
    }

    public function onceUsingId($id)
    {
        // TODO: Implement onceUsingId() method.
    }

    public function viaRemember()
    {
        // TODO: Implement viaRemember() method.
    }
}
