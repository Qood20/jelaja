<?php

namespace App\Policies;

use App\Models\Destination;
use App\Models\User;

class DestinationPolicy
{
    /**
     * Determine if the user can manage the destination.
     */
    public function manage(User $user, Destination $destination): bool
    {
        return $user->id === $destination->operator_id;
    }
}
