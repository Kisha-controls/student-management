@extends('layouts.main')
@section('title', 'Add student')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Students" title="Add a" accent="student"><a href="{{ route('students.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('students.store') }}" class="card p-6 sm:p-8 space-y-6">
        @csrf
        @include('students._form')
        <p class="text-xs text-[#7a6d7d]">A login account is created automatically with the default password <code>password</code>.</p>
        <button class="btn btn-primary">Save student</button>
    </form>
</section>
@endsection
