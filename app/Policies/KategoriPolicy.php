<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Auth\Access\HandlesAuthorization;

class KategoriPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the kategori.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return mixed
     */
    public function view(User $user, Kategori $kategori)
    {
        // Update $user authorization to view $kategori here.
        return true;
    }

    /**
     * Determine whether the user can create kategori.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return mixed
     */
    public function create(User $user, Kategori $kategori)
    {
        // Update $user authorization to create $kategori here.
        return true;
    }

    /**
     * Determine whether the user can update the kategori.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return mixed
     */
    public function update(User $user, Kategori $kategori)
    {
        // Update $user authorization to update $kategori here.
        return true;
    }

    /**
     * Determine whether the user can delete the kategori.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Kategori  $kategori
     * @return mixed
     */
    public function delete(User $user, Kategori $kategori)
    {
        // Update $user authorization to delete $kategori here.
        return true;
    }
}
