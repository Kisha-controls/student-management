<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = CourseRegistration::with(['student', 'course.lecturer'])->latest('registered_at');

        // Students only ever see their own registrations
        if (! $user->can('view registrations')) {
            $query->where('student_id', $user->student?->id ?? 0);
        }

        return view('registrations.index', ['registrations' => $query->paginate(10)]);
    }

    public function create()
    {
        return view('registrations.create', [
            'students' => Student::orderBy('name')->get(),
            'courses' => Course::orderBy('code')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->can('manage registrations')) {
            $data = $request->validate([
                'student_id' => ['required', 'exists:students,id'],
                'course_id' => ['required', 'exists:courses,id'],
            ]);
        } else {
            // A student can only register themselves
            $student = $user->student;
            abort_unless($student, 403, 'You do not have a student profile.');
            $data = $request->validate(['course_id' => ['required', 'exists:courses,id']]);
            $data['student_id'] = $student->id;
        }

        $course = Course::withCount('students')->findOrFail($data['course_id']);

        if (CourseRegistration::where($data)->exists()) {
            return back()->with('error', 'This student is already registered for '.$course->code.'.');
        }

        if ($course->students_count >= $course->capacity) {
            return back()->with('error', $course->code.' is full ('.$course->capacity.' students).');
        }

        CourseRegistration::create($data + ['registered_at' => now()]);

        return redirect()->route('registrations.index')->with('success', 'Registered for '.$course->code.' successfully.');
    }

    public function destroy(Request $request, CourseRegistration $registration)
    {
        $user = $request->user();

        if (! $user->can('manage registrations')) {
            // Students may only drop their own courses
            abort_unless($registration->student?->user_id === $user->id, 403, 'You can only drop your own registrations.');
        }

        $registration->delete();

        return back()->with('success', 'Registration removed.');
    }
}
