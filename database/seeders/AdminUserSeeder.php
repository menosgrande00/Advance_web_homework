<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::updateOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrator role']
        );

        $userRole = Role::updateOrCreate(
            ['name' => 'user'],
            ['description' => 'Regular user role']
        );

        $adminUser = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
            ]
        );

        $adminUser->roles()->syncWithoutDetaching([
            $adminRole->id,
            $userRole->id,
        ]);
    }
}