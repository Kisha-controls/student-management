@extends('layouts.main')
@section('title', 'Add user')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Users" title="Add a" accent="user"><a href="{{ route('users.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('users.store') }}" class="card p-6 sm:p-8 space-y-6">
        @csrf
        @include('admin.users._form')
        <button class="btn btn-primary">Create user</button>
    </form>
</section>
@endsection
