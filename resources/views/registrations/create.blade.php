@extends('layouts.main')
@section('title', 'Register a student')
@section('content')
<section class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Registrations" title="Register a" accent="student"><a href="{{ route('registrations.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('registrations.store') }}" class="card p-6 sm:p-8 space-y-5">
        @csrf
        <div>
            <label class="label" for="student_id">Student</label>
            <select class="field" id="student_id" name="student_id" required>
                <option value="">Select a student</option>
                @foreach ($students as $s)<option value="{{ $s->id }}" @selected(old('student_id') == $s->id)>{{ $s->student_number }} — {{ $s->name }}</option>@endforeach
            </select>
            @error('student_id')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="course_id">Course</label>
            <select class="field" id="course_id" name="course_id" required>
                <option value="">Select a course</option>
                @foreach ($courses as $c)<option value="{{ $c->id }}" @selected(old('course_id') == $c->id)>{{ $c->code }} — {{ $c->title }}</option>@endforeach
            </select>
            @error('course_id')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <button class="btn btn-primary">Register</button>
    </form>
</section>
@endsection
