<div class="grid sm:grid-cols-2 gap-5">
    <div class="sm:col-span-2">
        <label class="label" for="name">Full name</label>
        <input class="field" id="name" name="name" value="{{ old('name', $student->name ?? '') }}" required>
        @error('name')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="email">Email</label>
        <input class="field" type="email" id="email" name="email" value="{{ old('email', $student->email ?? '') }}" required>
        @error('email')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="student_number">Student number</label>
        <input class="field" id="student_number" name="student_number" value="{{ old('student_number', $student->student_number ?? '') }}" required>
        @error('student_number')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="phone">Phone (optional)</label>
        <input class="field" id="phone" name="phone" value="{{ old('phone', $student->phone ?? '') }}">
        @error('phone')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="programme">Programme</label>
        <input class="field" id="programme" name="programme" value="{{ old('programme', $student->programme ?? '') }}" required>
        @error('programme')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="year_of_study">Year of study</label>
        <select class="field" id="year_of_study" name="year_of_study">
            @for ($y = 1; $y <= 5; $y++)<option value="{{ $y }}" @selected(old('year_of_study', $student->year_of_study ?? 1) == $y)>Year {{ $y }}</option>@endfor
        </select>
    </div>
</div>
