<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether only admin can create, update, and delte kategori
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function manageKategories(User $user)
    {
        return $user->role_id == 1;;
    }


}
