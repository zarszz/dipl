<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Auth\Access\HandlesAuthorization;

class PembayaranPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create pembayaran.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !($user->role_id == 2);
    }

    /**
     * Determine whether the user can update the pembayaran.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return mixed
     */
    public function update(User $user, Pembayaran $pembayaran)
    {
        // Update $user authorization to update $pembayaran here.
        return $user->role_id == 1 || $user->id == $pembayaran->user_id;
    }

    /**
     * Determine whether the user can verify the pembayaran.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function verify(User $user)
    {
        // Update $user authorization to verify $pembayaran here.
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can delete the pembayaran.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return mixed
     */
    public function delete(User $user, Pembayaran $pembayaran)
    {
        // Update $user authorization to delete $pembayaran here.
        return $user->role_id == 1;
    }
}
