<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user_role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function view(User $user, UserRole $userRole)
    {
        // Update $user authorization to view $userRole here.
        return true;
    }

    /**
     * Determine whether the user can create user_role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function create(User $user, UserRole $userRole)
    {
        // Update $user authorization to create $userRole here.
        return true;
    }

    /**
     * Determine whether the user can update the user_role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function update(User $user, UserRole $userRole)
    {
        // Update $user authorization to update $userRole here.
        return true;
    }

    /**
     * Determine whether the user can delete the user_role.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRole  $userRole
     * @return mixed
     */
    public function delete(User $user, UserRole $userRole)
    {
        // Update $user authorization to delete $userRole here.
        return true;
    }
}
