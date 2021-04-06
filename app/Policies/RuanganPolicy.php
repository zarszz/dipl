<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RuanganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage ruangan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ruangan  $ruangan
     * @return mixed
     */
    public function view(User $user)
    {
        // Update $user authorization to view $ruangan here.
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can create ruangan.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Update $user authorization to create $ruangan here.
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can update the ruangan.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        // Update $user authorization to update $ruangan here.
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can destroy the ruangan.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        // Update $user authorization to delete $ruangan here.
        return $user->role_id == 1;
    }
}
