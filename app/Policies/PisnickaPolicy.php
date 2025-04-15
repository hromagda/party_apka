<?php

namespace App\Policies;

use App\Models\Pisnicka;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PisnickaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pisnicka $pisnicka): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('pridat_pisnicku');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pisnicka $pisnicka): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pisnicka $pisnicka): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pisnicka $pisnicka): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pisnicka $pisnicka): bool
    {
        return false;
    }
}
