@extends('layouts.main')
@section('title', 'Courses')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @can('view courses')
        <x-page-header eyebrow="Catalogue" title="Available" accent="courses">
            @can('create courses')<a href="{{ route('courses.create') }}" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Add course</a>@endcan
        </x-page-header>
    @else
        <x-page-header eyebrow="Lecturer" title="My assigned" accent="courses" />
    @endcan

    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Code</th><th>Course</th><th>Lecturer</th><th>CU</th><th>Seats</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @forelse ($courses as $c)
                <tr>
                    <td><span class="badge">{{ $c->code }}</span></td>
                    <td><p class="font-semibold text-plum-800">{{ $c->title }}</p></td>
                    <td>{{ $c->lecturer?->name ?? '—' }}</td>
                    <td>{{ $c->credit_units }}</td>
                    <td>{{ $c->students_count }} / {{ $c->capacity }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('courses.show', $c) }}" class="btn btn-ghost btn-sm">View</a>

                        @can('register courses')
                            @if (in_array($c->id, $registeredIds))
                                <span class="badge badge-amber">Registered</span>
                            @else
                                <form method="POST" action="{{ route('registrations.store') }}" class="inline">
                                    @csrf <input type="hidden" name="course_id" value="{{ $c->id }}">
                                    <button class="btn btn-primary btn-sm">Register</button>
                                </form>
                            @endif
                        @endcan

                        @can('edit courses')<a href="{{ route('courses.edit', $c) }}" class="btn btn-ghost btn-sm">Edit</a>@endcan
                        @can('delete courses')
                            <form method="POST" action="{{ route('courses.destroy', $c) }}" class="inline" onsubmit="return confirm('Delete {{ addslashes($c->code) }}?')">
                                @csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-[#7a6d7d] py-10">No courses to show.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $courses->links() }}</div>
</section>
@endsection
