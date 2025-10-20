<?php

namespace App\Policies;

use App\Models\IpLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class IpLogPolicy extends BasePolicy
{
    use HandlesAuthorization;
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
    public function view(User $user, IpLog $ipLog): bool
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
    public function update(User $user, IpLog $ipLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IpLog $ipLog): bool
    {
        return $this->can($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IpLog $ipLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IpLog $ipLog): bool
    {
        return $this->can($user);
    }

    private function can(User $user)
    {
        if ($user->class >= User::CLASS_SYSOP) {
            return true;
        }
        return false;
    }
}
