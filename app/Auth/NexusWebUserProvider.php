<?php
namespace App\Auth;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class NexusWebUserProvider implements UserProvider
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    public function __construct()
    {
        $this->query = User::query();
    }
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return $this->query->find($identifier);
    }


    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {

    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {

    }


    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        list($tokenJson, $signature) = explode('.', base64_decode($credentials["c_secure_pass"]));
        if (empty($tokenJson) || empty($signature)) {
            return null;
        }
        $tokenData = json_decode($tokenJson, true);
        if (!isset($tokenData['user_id'])) {
            return null;
        }
        return $this->retrieveById($tokenData['user_id']);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        list($tokenJson, $signature) = explode('.', base64_decode($credentials["c_secure_pass"]));
        $expectedSignature = hash_hmac('sha256', $tokenJson, $user->auth_key);
        return  hash_equals($expectedSignature, $signature);
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
        // TODO: Implement rehashPasswordIfRequired() method.
    }
}
