@extends('layouts.main')
@section('title', 'Create account')
@section('content')
<section class="max-w-xl mx-auto px-4 py-12">
    <div class="text-center mb-6">
        <p class="eyebrow mb-2">Students</p>
        <h1 class="font-display text-5xl text-plum-800">Create your <span class="accent">account</span></h1>
    </div>
    <form method="POST" action="{{ route('register') }}" class="card p-6 sm:p-8 grid sm:grid-cols-2 gap-5">
        @csrf
        <div class="sm:col-span-2">
            <label class="label" for="name">Full name</label>
            <input class="field" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="email">Email</label>
            <input class="field" type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="student_number">Student number</label>
            <input class="field" id="student_number" name="student_number" value="{{ old('student_number') }}" required>
            @error('student_number')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="programme">Programme</label>
            <input class="field" id="programme" name="programme" value="{{ old('programme') }}" required>
            @error('programme')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="year_of_study">Year of study</label>
            <select class="field" id="year_of_study" name="year_of_study">
                @for ($y = 1; $y <= 5; $y++)<option value="{{ $y }}" @selected(old('year_of_study', 1) == $y)>Year {{ $y }}</option>@endfor
            </select>
        </div>
        <div>
            <label class="label" for="password">Password</label>
            <input class="field" type="password" id="password" name="password" required>
            @error('password')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="label" for="password_confirmation">Confirm password</label>
            <input class="field" type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button class="btn btn-primary sm:col-span-2">Create account</button>
        <p class="text-sm text-center text-[#7a6d7d] sm:col-span-2">Already registered? <a href="{{ route('login') }}" class="font-semibold text-brand-dark">Sign in</a></p>
    </form>
</section>
@endsection
