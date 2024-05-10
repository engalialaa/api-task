<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BusinessLogic;

class InvalidCreidintial extends BusinessLogic {
    public function __construct () {
        Parent::__construct('Invalid username or password!' , 411);
    }
}
