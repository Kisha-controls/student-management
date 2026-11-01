@extends('layouts.main')
@section('title', 'Edit student')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Students" title="Edit" :accent="$student->name"><a href="{{ route('students.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('students.update', $student) }}" class="card p-6 sm:p-8 space-y-6">
        @csrf @method('PUT')
        @include('students._form')
        <button class="btn btn-primary">Update student</button>
    </form>
</section>
@endsection
