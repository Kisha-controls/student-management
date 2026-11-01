<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['Admin User', 'admin@sms.test', 'admin'],
            ['Dr. Grace Namutebi', 'lecturer1@sms.test', 'lecturer'],
            ['Mr. Peter Okello', 'lecturer2@sms.test', 'lecturer'],
        ];

        foreach ($accounts as [$name, $email, $role]) {
            // updateOrCreate => running the seeder again never creates duplicates
            $user = User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'password' => 'password',
            ]);
            $user->syncRoles([$role]);
        }
    }
}
