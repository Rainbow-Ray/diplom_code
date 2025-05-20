<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return RolesPolicy::all($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return RolesPolicy::all($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return RolesPolicy::all($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if(Auth::user()->id == $user->id){
            return true;
        }
        else{
            return RolesPolicy::director($user);
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return RolesPolicy::director($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return RolesPolicy::director($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return RolesPolicy::director($user);
    }
}
