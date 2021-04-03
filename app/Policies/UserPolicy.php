<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->role_id == 1 || $user->id == $model->id;
    }

    /**
     * Determine whether the user can view dashboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function viewDashboard(User $user)
    {
        return $user->role_id == 1;
    }

        /**
     * Determine whether the user can view dashboard.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function viewAll(User $user)
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can destroy the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function destroy(User $user, User $model)
    {
        return $user->role_id == 1 || $user->id == $model->id;
    }

    /**
     * Determine whether the user can verified user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function verifyUser(User $user)
    {
        return $user->role_id == 1;
    }
}
