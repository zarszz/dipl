<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticketing;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ticketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticketing  $ticketing
     * @return mixed
     */
    public function view(User $user, Ticketing $ticketing)
    {
        // Update $user authorization to view $ticketing here.
        return true;
    }

    /**
     * Determine whether the user can create ticketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticketing  $ticketing
     * @return mixed
     */
    public function create(User $user, Ticketing $ticketing)
    {
        // Update $user authorization to create $ticketing here.
        return true;
    }

    /**
     * Determine whether the user can update the ticketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticketing  $ticketing
     * @return mixed
     */
    public function update(User $user, Ticketing $ticketing)
    {
        // Update $user authorization to update $ticketing here.
        return true;
    }

    /**
     * Determine whether the user can delete the ticketing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticketing  $ticketing
     * @return mixed
     */
    public function delete(User $user, Ticketing $ticketing)
    {
        // Update $user authorization to delete $ticketing here.
        return true;
    }
}
