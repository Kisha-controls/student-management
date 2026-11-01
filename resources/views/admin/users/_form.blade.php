<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="label" for="name">Name</label>
        <input class="field" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
        @error('name')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="email">Email</label>
        <input class="field" type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="role">Role</label>
        <select class="field" id="role" name="role" required>
            @foreach ($roles as $role)
                @if (isset($user) || $role->name !== 'student')
                    <option value="{{ $role->name }}" @selected(old('role', isset($user) ? $user->roleName() : '') === $role->name)>{{ ucfirst($role->name) }}</option>
                @endif
            @endforeach
        </select>
        @error('role')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div></div>
    <div>
        <label class="label" for="password">Password @isset($user)<span class="font-normal text-[#7a6d7d]">(leave blank to keep)</span>@endisset</label>
        <input class="field" type="password" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
        @error('password')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="password_confirmation">Confirm password</label>
        <input class="field" type="password" id="password_confirmation" name="password_confirmation">
    </div>
</div>
