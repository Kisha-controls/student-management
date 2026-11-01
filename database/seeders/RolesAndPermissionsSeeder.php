<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'view students', 'create students', 'edit students', 'delete students',
            'view courses', 'create courses', 'edit courses', 'delete courses',
            'view assigned courses',
            'view registrations', 'manage registrations',
            'view own registrations', 'register courses',
            'manage users',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // Administrator: everything
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web'])
            ->syncPermissions(Permission::all());

        // Lecturer: only assigned courses and their registered students
        Role::firstOrCreate(['name' => 'lecturer', 'guard_name' => 'web'])
            ->syncPermissions(['view assigned courses']);

        // Student: available courses and their own registrations
        Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web'])
            ->syncPermissions(['view courses', 'view own registrations', 'register courses']);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
