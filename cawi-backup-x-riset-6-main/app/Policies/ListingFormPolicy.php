<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingFormPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function approve(User $user, Listing $listingForm): bool
    {
        return $user->hasRole('kortim') && $listingForm->status === 'pending';
    }
}
