<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->hasRole('admin')) {
            $data = [
                'stats' => [
                    'Students' => Student::count(),
                    'Courses' => Course::count(),
                    'Registrations' => CourseRegistration::count(),
                    'Lecturers' => User::role('lecturer')->count(),
                ],
                'latest' => CourseRegistration::with(['student', 'course'])->latest()->take(6)->get(),
            ];
        } elseif ($user->hasRole('lecturer')) {
            $courses = $user->taughtCourses()->withCount('students')->get();
            $data = [
                'courses' => $courses,
                'stats' => [
                    'Assigned courses' => $courses->count(),
                    'Registered students' => $courses->sum('students_count'),
                ],
            ];
        } else {
            $student = $user->student;
            $courses = $student ? $student->courses()->with('lecturer')->get() : collect();
            $data = [
                'student' => $student,
                'courses' => $courses,
                'stats' => [
                    'My courses' => $courses->count(),
                    'Credit units' => $courses->sum('credit_units'),
                    'Available courses' => Course::count(),
                ],
            ];
        }

        return view('dashboard', $data + ['role' => $user->roleName()]);
    }
}
