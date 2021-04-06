<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GudangPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage the gudang.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function manageGudang(User $user)
    {
       return $user->role_id == 1;
    }
}
