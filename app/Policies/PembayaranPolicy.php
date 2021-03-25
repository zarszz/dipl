<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Auth\Access\HandlesAuthorization;

class PembayaranPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pembayaran.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return mixed
     */
    public function view(User $user, Pembayaran $pembayaran)
    {
        // Update $user authorization to view $pembayaran here.
        return true;
    }

    /**
     * Determine whether the user can create pembayaran.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return mixed
     */
    public function create(User $user, Pembayaran $pembayaran)
    {
        // Update $user authorization to create $pembayaran here.
        return true;
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
        return true;
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
        return true;
    }
}
