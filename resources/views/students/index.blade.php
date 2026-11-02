@extends('layouts.main')

@section('title', 'Students')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-xs uppercase tracking-widest text-gray-500">
                Student Management
            </p>
            <h1 class="text-3xl font-semibold">Students</h1>
        </div>

        <a href="{{ route('students.create') }}"
           class="btn btn-primary">
            Add Student
        </a>
    </div>

    <form method="GET" action="{{ route('students.index') }}"
          class="mb-6">
        <input type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Search by name, student number or programme..."
               class="form-control w-full">

        <button type="submit" class="btn btn-primary mt-2">
            Search
        </button>
    </form>

    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student Number</th>
                    <th>Programme</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->student_number }}</td>
                        <td>{{ $student->programme }}</td>
                        <td>{{ $student->courses_count }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student) }}"
                               class="btn btn-ghost btn-sm">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('students.destroy', $student) }}"
                                  style="display:inline"
                                  onsubmit="return confirm('Are you sure you want to delete this student?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $students->links() }}
    </div>

</section>
@endsection