@extends('layouts.main')
@section('title', 'Edit user')
@section('content')
<section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Users" title="Edit" :accent="$user->name"><a href="{{ route('users.index') }}" class="btn btn-ghost">Back</a></x-page-header>
    <form method="POST" action="{{ route('users.update', $user) }}" class="card p-6 sm:p-8 space-y-6">
        @csrf @method('PUT')
        @include('admin.users._form')
        <button class="btn btn-primary">Update user</button>
    </form>
</section>
@endsection
