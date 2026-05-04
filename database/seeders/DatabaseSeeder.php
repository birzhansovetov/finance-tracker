<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'view analytics',
            'view reports',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $owner = Role::firstOrCreate(['name' => 'owner']);
        $accountant = Role::firstOrCreate(['name' => 'accountant']);
        $analyst = Role::firstOrCreate(['name' => 'analyst']);
        $viewer = Role::firstOrCreate(['name' => 'viewer']);

        $owner->givePermissionTo(Permission::all());

        $accountant->givePermissionTo([
            'view dashboard',
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'view reports',
        ]);

        $analyst->givePermissionTo([
            'view dashboard',
            'view transactions',
            'view analytics',
            'view reports',
        ]);

        $viewer->givePermissionTo([
            'view dashboard',
            'view transactions',
        ]);

        $user1 = User::firstOrCreate(
            ['email' => 'owner@test.com'],
            [
                'name' => 'Owner User',
                'password' => Hash::make('123456'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'accountant@test.com'],
            [
                'name' => 'Accountant User',
                'password' => Hash::make('123456'),
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'analyst@test.com'],
            [
                'name' => 'Analyst User',
                'password' => Hash::make('123456'),
            ]
        );

        $user4 = User::firstOrCreate(
            ['email' => 'viewer@test.com'],
            [
                'name' => 'Viewer User',
                'password' => Hash::make('123456'),
            ]
        );

        $user1->syncRoles(['owner']);
        $user2->syncRoles(['accountant']);
        $user3->syncRoles(['analyst']);
        $user4->syncRoles(['viewer']);
    }
}