<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApartmentPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function pay(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }
}
