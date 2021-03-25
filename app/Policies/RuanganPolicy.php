<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Auth\Access\HandlesAuthorization;

class RuanganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ruangan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ruangan  $ruangan
     * @return mixed
     */
    public function view(User $user, Ruangan $ruangan)
    {
        // Update $user authorization to view $ruangan here.
        return true;
    }

    /**
     * Determine whether the user can create ruangan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ruangan  $ruangan
     * @return mixed
     */
    public function create(User $user, Ruangan $ruangan)
    {
        // Update $user authorization to create $ruangan here.
        return true;
    }

    /**
     * Determine whether the user can update the ruangan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ruangan  $ruangan
     * @return mixed
     */
    public function update(User $user, Ruangan $ruangan)
    {
        // Update $user authorization to update $ruangan here.
        return true;
    }

    /**
     * Determine whether the user can delete the ruangan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ruangan  $ruangan
     * @return mixed
     */
    public function delete(User $user, Ruangan $ruangan)
    {
        // Update $user authorization to delete $ruangan here.
        return true;
    }
}
