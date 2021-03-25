<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Auth\Access\HandlesAuthorization;

class BarangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the barang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function view(User $user, Barang $barang)
    {
        // Update $user authorization to view $barang here.
        return true;
    }

    /**
     * Determine whether the user can create barang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function create(User $user, Barang $barang)
    {
        // Update $user authorization to create $barang here.
        return true;
    }

    /**
     * Determine whether the user can update the barang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function update(User $user, Barang $barang)
    {
        // Update $user authorization to update $barang here.
        return true;
    }

    /**
     * Determine whether the user can delete the barang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Barang  $barang
     * @return mixed
     */
    public function delete(User $user, Barang $barang)
    {
        // Update $user authorization to delete $barang here.
        return true;
    }
}
