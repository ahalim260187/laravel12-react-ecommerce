<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RoleEnum::USER->value]);
        $vendorRole = Role::create(['name' => RoleEnum::VENDOR->value]);
        $adminRole = Role::create(['name' => RoleEnum::ADMIN->value]);

        $approveVendor = Permission::create(['name' => PermissionEnum::ApproveVendor->value]);
        $sellProducts = Permission::create(['name' => PermissionEnum::SellProducts->value]);
        $buyProducts = Permission::create(['name' => PermissionEnum::BuyProducts->value]);

        $userRole->syncPermissions([$buyProducts]);
        $vendorRole->syncPermissions([$sellProducts, $buyProducts]);
        $adminRole->syncPermissions([$approveVendor, $sellProducts, $buyProducts]);
    }
}
