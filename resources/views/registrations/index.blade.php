@extends('layouts.main')
@section('title', 'Registrations')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @can('view registrations')
        <x-page-header eyebrow="Records" title="Course" accent="registrations">
            @can('manage registrations')<a href="{{ route('registrations.create') }}" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Register a student</a>@endcan
        </x-page-header>
    @else
        <x-page-header eyebrow="Student" title="My" accent="registrations">
            <a href="{{ route('courses.index') }}" class="btn btn-primary">Register for a course</a>
        </x-page-header>
    @endcan

    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr>@can('view registrations')<th>Student</th>@endcan<th>Course</th><th>Lecturer</th><th>Registered</th><th class="text-right">Action</th></tr></thead>
            <tbody>
            @forelse ($registrations as $r)
                <tr>
                    @can('view registrations')<td><p class="font-semibold text-plum-800">{{ $r->student->name }}</p><p class="text-xs text-[#7a6d7d]">{{ $r->student->student_number }}</p></td>@endcan
                    <td><span class="badge">{{ $r->course->code }}</span> {{ $r->course->title }}</td>
                    <td>{{ $r->course->lecturer?->name ?? '—' }}</td>
                    <td>{{ $r->registered_at?->format('d M Y') }}</td>
                    <td class="text-right">
                        <form method="POST" action="{{ route('registrations.destroy', $r) }}" onsubmit="return confirm('Remove this registration?')">
                            @csrf @method('DELETE')<button class="btn btn-danger btn-sm">@can('manage registrations') Remove @else Drop @endcan</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-[#7a6d7d] py-10">No registrations yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $registrations->links() }}</div>
</section>
@endsection
