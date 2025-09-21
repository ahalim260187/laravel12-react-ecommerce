<?php

namespace App\Enums;

enum PermissionEnum :string
{
    case ApproveVendor = 'ApproveVendor';
    case SellProducts = 'SellProducts';
    case BuyProducts = 'BuyProducts';
}
