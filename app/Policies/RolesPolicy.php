<?php

namespace App\Policies;

use App\Models\User;

class RolesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public static function director(User $user): bool
    {
        $roles = $user->roles();

        if (in_array('director', $roles)  || in_array('admin', $roles)) {
            return true;
        }
        return false;
    }

    public static function directorAndEconomist(User $user): bool
    {
        $roles = $user->roles();

        if (
            in_array('director', $roles)
            || in_array('admin', $roles)
            || in_array('economist', $roles)

        ) {

            return true;
        }
        return false;
    }

    public static function motMaster(User $user)
    {
        $roles = $user->roles();

        if (
            in_array('director', $roles)
            || in_array('admin', $roles)
            || in_array('economist', $roles)
            || in_array('manager', $roles)

        ) {

            return true;
        }
        return false;
    }

    public static function all(User $user): bool
    {
        $roles = $user->roles();

        if (
            in_array('director', $roles)
            || in_array('economist', $roles)
            || in_array('admin', $roles)
            || in_array('manager', $roles)
            || in_array('master', $roles)
            || !is_null($user->email)
        ) {
            return true;
        }
        return false;
    }
    public static function manager(User $user): bool
    {
        $roles = $user->roles();

        if (
            in_array('admin', $roles)
            || in_array('manager', $roles)
        ) {
            return true;
        }
        return false;
    }

    public static function economistAndMaster(User $user): bool
    {
        $roles = $user->roles();

        if (
            in_array('admin', $roles)
            || in_array('economist', $roles)
            || in_array('master', $roles)
        ) {
            return true;
        }
        return false;
    }
}
