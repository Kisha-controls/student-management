@extends('layouts.main')

@section('title', 'Add Student')

@section('content')

<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <p class="text-xs uppercase tracking-widest text-gray-500">
            Student Management
        </p>

        <h1 class="text-3xl font-semibold">Add Student</h1>
        <p class="text-gray-500 mt-2">
            Enter the student's details below.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block mb-2 font-medium">
                        Student Number
                    </label>
                    <input type="text"
                           name="student_number"
                           value="{{ old('student_number') }}"
                           placeholder="e.g. 2024/BBC/001"
                           class="form-control w-full"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Full Name
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter full name"
                           class="form-control w-full"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Email Address
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="student@example.com"
                           class="form-control w-full"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Phone Number
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Enter phone number"
                           class="form-control w-full">
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Programme
                    </label>
                    <input type="text"
                           name="programme"
                           value="{{ old('programme') }}"
                           placeholder="e.g. Business Computing"
                           class="form-control w-full"
                           required>
                </div>

                <div>
                    <label class="block mb-2 font-medium">
                        Year of Study
                    </label>
                    <select name="year_of_study"
                            class="form-control w-full"
                            required>
                        <option value="">Select year</option>

                        @for ($year = 1; $year <= 5; $year++)
                            <option value="{{ $year }}"
                                {{ old('year_of_study') == $year ? 'selected' : '' }}>
                                Year {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>

            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn btn-primary">
                    Save Student
                </button>

                <a href="{{ route('students.index') }}"
                   class="btn btn-ghost">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</section>

@endsection