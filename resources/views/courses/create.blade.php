@extends('layouts.main')
@section('title', 'Add course')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Courses" title="Add a" accent="course"><a href="{{ route('courses.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('courses.store') }}" class="card p-6 sm:p-8 space-y-6">
        @csrf
        @include('courses._form')
        <button class="btn btn-primary">Save course</button>
    </form>
</section>
@endsection
