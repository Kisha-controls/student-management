<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $l1 = User::where('email', 'lecturer1@sms.test')->value('id');
        $l2 = User::where('email', 'lecturer2@sms.test')->value('id');

        $courses = [
            ['BUC3131', 'Advanced Web Application Development', 'Building secure, database-driven web apps with Laravel.', 4, 60, $l1],
            ['BUC3112', 'Database Systems', 'Relational design, SQL and normalisation.', 3, 60, $l1],
            ['BBC3127', 'Accounting Information Systems', 'Accounting software and AIS concepts.', 3, 50, $l2],
            ['BUC3105', 'Software Engineering', 'Requirements, design, testing and teamwork with Git.', 4, 50, $l2],
        ];

        foreach ($courses as [$code, $title, $description, $units, $capacity, $lecturer]) {
            Course::updateOrCreate(['code' => $code], [
                'title' => $title,
                'description' => $description,
                'credit_units' => $units,
                'capacity' => $capacity,
                'lecturer_id' => $lecturer,
            ]);
        }
    }
}
