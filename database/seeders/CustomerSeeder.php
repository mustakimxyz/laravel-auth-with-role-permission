<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = \App\Models\User::create([
            'name' => 'Customer User',
            'email' => 'customer@admin.com',
            'password' => bcrypt('admin'),
            'approval_status'=>'accepted',
            'avatar' => ''
        ]);
        $customer->assignRole('customer');
        $customer = \App\Models\User::create([
            'name' => 'Customer User1',
            'email' => 'customer1@admin.com',
            'password' => bcrypt('admin'),
            'approval_status'=>'rejected',
            'avatar' => ''
        ]);
        $customer->assignRole('customer');
        $customer = \App\Models\User::create([
            'name' => 'Customer User2',
            'email' => 'customer2@admin.com',
            'password' => bcrypt('admin'),
            'approval_status'=>'on_review',
            'avatar' => ''
        ]);
        $customer->assignRole('customer');
    }
}
