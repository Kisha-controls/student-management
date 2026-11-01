<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Course::with('lecturer')->withCount('students')->orderBy('code');

        // Lecturers (who cannot "view courses") only see the courses assigned to them
        if (! $user->can('view courses')) {
            $query->where('lecturer_id', $user->id);
        }

        $courses = $query->paginate(10);

        // Ids of the courses the logged in student already registered for
        $registeredIds = $user->student
            ? $user->student->courses()->pluck('courses.id')->all()
            : [];

        return view('courses.index', compact('courses', 'registeredIds'));
    }

    public function create()
    {
        return view('courses.create', ['lecturers' => User::role('lecturer')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        Course::create($this->validated($request));

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Request $request, Course $course)
    {
        $user = $request->user();

        // Prevent a lecturer from opening somebody else's course
        if (! $user->can('view courses')) {
            abort_unless($course->lecturer_id === $user->id, 403, 'This course is not assigned to you.');
        }

        $course->load('lecturer');
        // Eloquent: students registered for this course (admin + owning lecturer only)
        $students = $user->can('view courses') && ! $user->can('view registrations')
            ? collect()
            : $course->students()->orderBy('name')->get();

        return view('courses.show', compact('course', 'students'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', [
            'course' => $course,
            'lecturers' => User::role('lecturer')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($this->validated($request, $course));

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }

    private function validated(Request $request, ?Course $course = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:20', Rule::unique('courses')->ignore($course?->id)],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'credit_units' => ['required', 'integer', 'between:1,10'],
            'capacity' => ['required', 'integer', 'between:1,500'],
            'lecturer_id' => ['nullable', 'exists:users,id'],
        ]);
    }
}
