<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['2024/BBC/001', 'Racheal Kibuuka', 'student1@sms.test', 'Business Computing', 3],
            ['2024/BBC/002', 'Brian Mugisha', 'student2@sms.test', 'Business Computing', 3],
            ['2024/BBC/003', 'Sarah Nabirye', 'student3@sms.test', 'Business Computing', 2],
            ['2024/BIT/004', 'David Ssemwogerere', 'student4@sms.test', 'Information Technology', 3],
            ['2024/BIT/005', 'Aisha Namugga', 'student5@sms.test', 'Information Technology', 1],
            ['2024/BAC/006', 'Joel Ochieng', 'student6@sms.test', 'Accounting', 2],
        ];

        foreach ($students as [$number, $name, $email, $programme, $year]) {
            $user = User::updateOrCreate(['email' => $email], ['name' => $name, 'password' => 'password']);
            $user->syncRoles(['student']);

            Student::updateOrCreate(['student_number' => $number], [
                'user_id' => $user->id,
                'name' => $name,
                'email' => $email,
                'programme' => $programme,
                'year_of_study' => $year,
            ]);
        }
    }
}
