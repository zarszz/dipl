<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GudangPolicy
{
    use HandlesAuthorization;

    private $NOT_ALLOWED = "You do not allow to perform this method";

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
        return $user->role_id == 1
                    ? Response::allow()
                    : Response::deny($this->NOT_ALLOWED);
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
        return $user->role_id == 1
                    ? Response::allow()
                    : Response::deny($this->NOT_ALLOWED);
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
        return $user->role_id == 1
                    ? Response::allow()
                    : Response::deny($this->NOT_ALLOWED);
    }
}
