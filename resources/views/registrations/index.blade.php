@extends('layouts.main')

@section('title', 'Course Registrations')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs uppercase tracking-widest text-gray-500">
                Registry
            </p>
            <h1 class="text-3xl font-serif">Course Registrations</h1>
        </div>

        @can('manage registrations')
            <a href="{{ route('registrations.create') }}"
               class="btn btn-primary">
                New Registration
            </a>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Course</th>
                    <th>Lecturer</th>
                    <th>Registration Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td>
                            {{ $registration->student->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $registration->course->title ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $registration->course->lecturer->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $registration->registered_at
                                ? \Carbon\Carbon::parse($registration->registered_at)->format('d M Y')
                                : 'N/A' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6">
                            No registrations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $registrations->links() }}
    </div>

</section>
@endsection