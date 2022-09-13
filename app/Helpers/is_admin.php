<?php

use App\Models\User;
use App\Helpers\Enums\RolesEnam;

if (!function_exists('isAdmin'))
{
    function isAdmin(User $user): bool
    {
        return $user->role->name === \App\Helpers\Enums\RolesEnam::Admin->value;
    }
}
