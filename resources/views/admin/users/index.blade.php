@extends('layouts.main')
@section('title', 'User access')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <x-page-header eyebrow="Administration" title="User" accent="access">
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Add user</a>
    </x-page-header>
    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            @foreach ($users as $u)
                <tr>
                    <td class="font-semibold text-plum-800">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge {{ $u->hasRole('admin') ? 'badge-plum' : ($u->hasRole('lecturer') ? 'badge-amber' : '') }} capitalize">{{ $u->roleName() }}</span></td>
                    <td class="text-right whitespace-nowrap">
                        <a href="{{ route('users.edit', $u) }}" class="btn btn-ghost btn-sm">Edit</a>
                        @if ($u->id !== auth()->id())
                            <form method="POST" action="{{ route('users.destroy', $u) }}" class="inline" onsubmit="return confirm('Delete {{ addslashes($u->name) }}?')">
                                @csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $users->links() }}</div>
</section>
@endsection
