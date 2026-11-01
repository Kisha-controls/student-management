<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // student number => course codes
        $map = [
            '2024/BBC/001' => ['BUC3131', 'BUC3112', 'BUC3105'],
            '2024/BBC/002' => ['BUC3131', 'BBC3127'],
            '2024/BBC/003' => ['BUC3112', 'BBC3127'],
            '2024/BIT/004' => ['BUC3131', 'BUC3105'],
            '2024/BIT/005' => ['BUC3112'],
            '2024/BAC/006' => ['BBC3127', 'BUC3105'],
        ];

        foreach ($map as $number => $codes) {
            $student = Student::where('student_number', $number)->first();
            foreach ($codes as $code) {
                $course = Course::where('code', $code)->first();
                if ($student && $course) {
                    CourseRegistration::firstOrCreate(
                        ['student_id' => $student->id, 'course_id' => $course->id],
                        ['registered_at' => now()]
                    );
                }
            }
        }
    }
}
