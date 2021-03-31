<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Auth\Access\HandlesAuthorization;

class GudangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the gudang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gudang  $gudang
     * @return mixed
     */
    public function view(User $user, Gudang $gudang)
    {
        // Update $user authorization to view $gudang here.
        return true;
    }

    /**
     * Determine whether the user can create gudang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gudang  $gudang
     * @return mixed
     */
    public function create(User $user, Gudang $gudang)
    {
        // Update $user authorization to create $gudang here.
        return true;
    }

    /**
     * Determine whether the user can update the gudang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gudang  $gudang
     * @return mixed
     */
    public function update(User $user, Gudang $gudang)
    {
        // Update $user authorization to update $gudang here.
        return true;
    }

    /**
     * Determine whether the user can delete the gudang.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Gudang  $gudang
     * @return mixed
     */
    public function delete(User $user, Gudang $gudang)
    {
        // Update $user authorization to delete $gudang here.
        return true;
    }
}
