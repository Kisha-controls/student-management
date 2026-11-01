@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header :eyebrow="ucfirst($role).' dashboard'" title="Hello," :accent="auth()->user()->name">
        @can('register courses') <a href="{{ route('courses.index') }}" class="btn btn-primary">Browse courses</a> @endcan
        @can('create students') <a href="{{ route('students.create') }}" class="btn btn-primary">Add student</a> @endcan
    </x-page-header>

    <div class="grid sm:grid-cols-2 lg:grid-cols-{{ min(count($stats), 4) }} gap-4 mb-10">
        @foreach ($stats as $label => $value)
            <div class="plum-card p-5"><p class="label">{{ $label }}</p><p class="big mt-3">{{ $value }}</p></div>
        @endforeach
    </div>

    @if ($role === 'admin')
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-[#f0e8da]"><h2 class="font-display text-2xl text-plum-800">Latest registrations</h2></div>
            <table class="table">
                <thead><tr><th>Student</th><th>Course</th><th>Date</th></tr></thead>
                <tbody>
                @forelse ($latest as $r)
                    <tr><td>{{ $r->student->name }}</td><td>{{ $r->course->code }} — {{ $r->course->title }}</td><td>{{ $r->registered_at?->format('d M Y') }}</td></tr>
                @empty
                    <tr><td colspan="3" class="text-center text-[#7a6d7d] py-8">No registrations yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @elseif ($role === 'lecturer')
        <h2 class="font-display text-3xl text-plum-800 mb-4">My assigned courses</h2>
        <div class="grid md:grid-cols-2 gap-4">
            @forelse ($courses as $c)
                <a href="{{ route('courses.show', $c) }}" class="card p-5 hover:border-brand transition">
                    <span class="badge">{{ $c->code }}</span>
                    <p class="font-semibold text-plum-800 mt-2">{{ $c->title }}</p>
                    <p class="text-sm text-[#7a6d7d] mt-1">{{ $c->students_count }} registered {{ Str::plural('student', $c->students_count) }}</p>
                </a>
            @empty
                <p class="text-[#7a6d7d]">No courses have been assigned to you yet.</p>
            @endforelse
        </div>
    @else
        <h2 class="font-display text-3xl text-plum-800 mb-4">My registered courses</h2>
        <div class="grid md:grid-cols-2 gap-4">
            @forelse ($courses as $c)
                <div class="card p-5">
                    <span class="badge">{{ $c->code }}</span> <span class="badge badge-plum">{{ $c->credit_units }} CU</span>
                    <p class="font-semibold text-plum-800 mt-2">{{ $c->title }}</p>
                    <p class="text-sm text-[#7a6d7d] mt-1">Lecturer: {{ $c->lecturer?->name ?? 'To be assigned' }}</p>
                </div>
            @empty
                <p class="text-[#7a6d7d]">You have not registered for any course yet. <a class="font-semibold text-brand-dark" href="{{ route('courses.index') }}">Browse courses</a>.</p>
            @endforelse
        </div>
    @endif
</section>
@endsection
