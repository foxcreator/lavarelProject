<?php
namespace App\Helpers\Enums;


enum RolesEnam: string
{
    case Admin = "Admin";
    case Customer = "Customer";

    public static function findByKey(string $key) {
        return constant("self::$key");
    }
}


