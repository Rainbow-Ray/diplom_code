<?php

namespace App\Policies;

use App\Models\User;

class ReportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function form(User $user)
    {

        return RolesPolicy::directorAndEconomist($user);
    }


}
