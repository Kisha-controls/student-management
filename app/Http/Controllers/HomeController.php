<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'studentCount' => Student::count(),
            'courseCount' => Course::count(),
            'registrationCount' => CourseRegistration::count(),
        ]);
    }

    public function contact()
    {
        return view('contact');
    }
}
