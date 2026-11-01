@extends('layouts.main')
@section('title', 'Contact us')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-2 gap-10 items-start">
        <div>
            <p class="eyebrow mb-2">Contact us</p>
            <h1 class="font-display text-5xl text-plum-800 leading-tight">Questions about <span class="accent">registration?</span></h1>
            <p class="text-[#6d6070] mt-4 mb-8 max-w-md">Send a message to the registry office and we will get back to you within two working days.</p>
            <div class="space-y-3 max-w-md">
                <div class="card p-4 flex gap-3 items-center"><i data-lucide="mail" class="w-5 h-5 text-brand-dark"></i><span class="text-sm">registry@sms.test</span></div>
                <div class="card p-4 flex gap-3 items-center"><i data-lucide="clock" class="w-5 h-5 text-brand-dark"></i><span class="text-sm">Monday–Friday, 8:00am – 5:00pm</span></div>
            </div>
        </div>

        <form method="POST" action="{{ route('contact.store') }}" class="card p-6 sm:p-8 space-y-5">
            @csrf
            <div>
                <label class="label" for="full_name">Full name</label>
                <input class="field" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                @error('full_name')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label" for="campus_email">Email</label>
                <input class="field" type="email" id="campus_email" name="campus_email" value="{{ old('campus_email') }}" required>
                @error('campus_email')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label" for="department">Department</label>
                <input class="field" id="department" name="department" value="{{ old('department') }}" required>
                @error('department')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="label" for="message">Message</label>
                <textarea class="field" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                @error('message')<p class="field-error">{{ $message }}</p>@enderror
            </div>
            <button class="btn btn-primary w-full">Send message</button>
        </form>
    </div>
</section>
@endsection
