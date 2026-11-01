@extends('layouts.main')
@section('title', $course->code)
@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header :eyebrow="$course->code" :title="$course->title"><a href="{{ route('courses.index') }}" class="btn btn-ghost">Back</a></x-page-header>

    <div class="plum-card p-6 grid sm:grid-cols-3 gap-4 mb-8">
        <div><p class="label">Lecturer</p><p class="mt-1">{{ $course->lecturer?->name ?? 'Not assigned' }}</p></div>
        <div><p class="label">Credit units</p><p class="mt-1">{{ $course->credit_units }}</p></div>
        <div><p class="label">Capacity</p><p class="mt-1">{{ $course->capacity }} seats</p></div>
        @if ($course->description)<p class="sm:col-span-3 text-sm text-white/80">{{ $course->description }}</p>@endif
    </div>

    @canany(['view registrations', 'view assigned courses'])
        <h2 class="font-display text-3xl text-plum-800 mb-4">Registered students ({{ $students->count() }})</h2>
        <div class="card overflow-x-auto">
            <table class="table">
                <thead><tr><th>Student no.</th><th>Name</th><th>Programme</th><th>Registered</th></tr></thead>
                <tbody>
                @forelse ($students as $s)
                    <tr><td><span class="badge badge-plum">{{ $s->student_number }}</span></td><td>{{ $s->name }}</td><td>{{ $s->programme }}</td><td>{{ \Illuminate\Support\Carbon::parse($s->pivot->registered_at)->format('d M Y') }}</td></tr>
                @empty
                    <tr><td colspan="4" class="text-center text-[#7a6d7d] py-8">No students registered yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    @endcanany
</section>
@endsection
