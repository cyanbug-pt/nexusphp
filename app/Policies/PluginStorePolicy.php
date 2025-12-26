<?php

namespace App\Policies;

use App\Models\PluginStore;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PluginStorePolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->can($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PluginStore $pluginStore): bool
    {
        return $this->can($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PluginStore $pluginStore): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PluginStore $pluginStore): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PluginStore $pluginStore): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PluginStore $pluginStore): bool
    {
        return false;
    }

    private function can(User $user)
    {
        if ($user->class >= User::CLASS_SYSOP) {
            return true;
        }
        return false;
    }
}
