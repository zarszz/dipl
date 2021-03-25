<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KendaraanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the kendaraan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return mixed
     */
    public function view(User $user, Kendaraan $kendaraan)
    {
        // Update $user authorization to view $kendaraan here.
        return true;
    }

    /**
     * Determine whether the user can create kendaraan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return mixed
     */
    public function create(User $user, Kendaraan $kendaraan)
    {
        // Update $user authorization to create $kendaraan here.
        return true;
    }

    /**
     * Determine whether the user can update the kendaraan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return mixed
     */
    public function update(User $user, Kendaraan $kendaraan)
    {
        // Update $user authorization to update $kendaraan here.
        return true;
    }

    /**
     * Determine whether the user can delete the kendaraan.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return mixed
     */
    public function delete(User $user, Kendaraan $kendaraan)
    {
        // Update $user authorization to delete $kendaraan here.
        return true;
    }
}
