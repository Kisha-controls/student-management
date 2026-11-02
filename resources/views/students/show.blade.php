@extends('layouts.main')
@section('title', $student->name)
@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Student profile" :title="$student->name"><a href="{{ route('students.index') }}" class="btn btn-ghost">Back</a></x-page-header>

    <div class="plum-card p-6 grid sm:grid-cols-4 gap-4 mb-8">
        <div><p class="label">Student no.</p><p class="mt-1 font-semibold">{{ $student->student_number }}</p></div>
        <div><p class="label">Email</p><p class="mt-1 text-sm break-all">{{ $student->email }}</p></div>
        <div><p class="label">Programme</p><p class="mt-1 text-sm">{{ $student->programme }}</p></div>
        <div><p class="label">Year</p><p class="mt-1 text-sm">Year {{ $student->year_of_study }}</p></div>
    </div>

    <h2 class="font-display text-3xl text-plum-800 mb-4">Registered courses ({{ $student->courses->count() }})</h2>
    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Code</th><th>Title</th><th>Lecturer</th><th>Registered</th></tr></thead>
            <tbody>
            @forelse ($student->courses as $c)
                <tr><td><span class="badge">{{ $c->code }}</span></td><td>{{ $c->title }}</td><td>{{ $c->lecturer?->name ?? '—' }}</td><td>{{ \Illuminate\Support\Carbon::parse($c->pivot->registered_at)->format('d M Y') }}</td></tr>
            @empty
                <tr><td colspan="4" class="text-center text-[#7a6d7d] py-8">Not registered for any course.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
