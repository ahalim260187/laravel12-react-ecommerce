<?php

namespace App\Enums;

enum RoleEnum : string
{
    case ADMIN = 'Admin';
    case VENDOR = 'Vendor';     
    case USER = 'User';
}
