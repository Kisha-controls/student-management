@extends('layouts.main')
@section('title', 'Students')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Records" title="All" accent="students">
        @can('create students')<a href="{{ route('students.create') }}" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Add student</a>@endcan
    </x-page-header>

    <form method="GET" class="mb-5 flex gap-2 max-w-md">
        <input class="field" name="q" value="{{ request('q') }}" placeholder="Search name, number or programme">
        <button class="btn btn-plum">Search</button>
    </form>

    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Student no.</th><th>Name</th><th>Programme</th><th>Year</th><th>Courses</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @forelse ($students as $s)
                <tr>
                    <td><span class="badge badge-plum">{{ $s->student_number }}</span></td>
                    <td><p class="font-semibold text-plum-800">{{ $s->name }}</p><p class="text-xs text-[#7a6d7d]">{{ $s->email }}</p></td>
                    <td>{{ $s->programme }}</td>
                    <td>Year {{ $s->year_of_study }}</td>
                    <td>{{ $s->courses_count }}</td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('students.show', $s) }}" class="btn btn-ghost btn-sm">View</a>
                        @can('edit students')<a href="{{ route('students.edit', $s) }}" class="btn btn-ghost btn-sm">Edit</a>@endcan
                        @can('delete students')
                            <form method="POST" action="{{ route('students.destroy', $s) }}" class="inline" onsubmit="return confirm('Delete {{ addslashes($s->name) }}?')">
                                @csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-[#7a6d7d] py-10">No students found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $students->links() }}</div>
</section>
@endsection
