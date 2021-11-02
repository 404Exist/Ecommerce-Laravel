<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Show Admin Account',
            'Add Admin Account',
            'Edit Admin Account',
            'Delete Admin Account',

            'Show User Account',
            'Add User Account',
            'Edit User Account',
            'Delete User Account',

            'Show Website Settings',
            'Add Website Settings',
            'Edit Website Settings',
            'Delete Website Settings',

            'Show Countries',
            'Add Countries',
            'Edit Countries',
            'Delete Countries',

            'Show Cities',
            'Add Cities',
            'Edit Cities',
            'Delete Cities',

            'Show States',
            'Add States',
            'Edit States',
            'Delete States',

            'Show Departments',
            'Add Departments',
            'Edit Departments',
            'Delete Departments',

            'Show Trademarks',
            'Add Trademarks',
            'Edit Trademarks',
            'Delete Trademarks',

            'Show Manufacturers',
            'Add Manufacturers',
            'Edit Manufacturers',
            'Delete Manufacturers',

            'Show Shipping Companies',
            'Add Shipping Companies',
            'Edit Shipping Companies',
            'Delete Shipping Companies',

            'Show Malls',
            'Add Malls',
            'Edit Malls',
            'Delete Malls',

            'Show Colors',
            'Add Colors',
            'Edit Colors',
            'Delete Colors',

            'Show Sizes',
            'Add Sizes',
            'Edit Sizes',
            'Delete Sizes',

            'Show Weights',
            'Add Weights',
            'Edit Weights',
            'Delete Weights',

            'Show Products',
            'Add Products',
            'Edit Products',
            'Delete Products',

            'Show Role',
            'Add Role',
            'Edit Role',
            'Delete Role',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
