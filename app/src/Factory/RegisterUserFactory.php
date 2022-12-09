<?php

namespace App\Factory;

use App\Entity\User;

class RegisterUserFactory
{

    public static function registerUserFromParams($dataObjectRegistration){
        $user = new User();
        $user->setUsername($dataObjectRegistration->getUsername());
        return $user;

    }
}