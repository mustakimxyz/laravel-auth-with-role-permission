<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
        ]);

        $customer = Role::create([
            'name' => 'customer',
        ]);

        Permission::create(['name' => 'view-customer']);
        Permission::create(['name' => 'edit-customer']);
        Permission::create(['name' => 'update-customer']);
        Permission::create(['name' => 'delete-customer']);
        Permission::create(['name' => 'accept-customer']);
        Permission::create(['name' => 'reject-customer']);


        $admin   = Role::findByName('admin');
        $admin->givePermissionTo(
            'view-customer',
            'edit-customer',
            'update-customer',
            'delete-customer',
            'accept-customer',
            'reject-customer'
        );
    }
}
