<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::withCount('courses')
            ->when($request->q, fn ($q, $term) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$term}%")
                ->orWhere('student_number', 'like', "%{$term}%")
                ->orWhere('programme', 'like', "%{$term}%")))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email', 'unique:users,email'],
            'student_number' => ['required', 'string', 'max:50', 'unique:students,student_number'],
            'phone' => ['nullable', 'string', 'max:30'],
            'programme' => ['required', 'string', 'max:255'],
            'year_of_study' => ['required', 'integer', 'between:1,5'],
        ]);

        DB::transaction(function () use ($data) {
            // Every student gets a login account (default password: "password")
            $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => 'password']);
            $user->assignRole('student');
            Student::create($data + ['user_id' => $user->id]);
        });

        return redirect()->route('students.index')->with('success', 'Student created. Default password is "password".');
    }

    public function show(Student $student)
    {
        // Eloquent: all courses this student is registered for
        $student->load('courses.lecturer');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id), Rule::unique('users')->ignore($student->user_id)],
            'student_number' => ['required', 'string', 'max:50', Rule::unique('students')->ignore($student->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'programme' => ['required', 'string', 'max:255'],
            'year_of_study' => ['required', 'integer', 'between:1,5'],
        ]);

        DB::transaction(function () use ($student, $data) {
            $student->update($data);
            $student->user?->update(['name' => $data['name'], 'email' => $data['email']]);
        });

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $user = $student->user;
            $student->delete();   // registrations are removed by the foreign key cascade
            $user?->delete();
        });

        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
