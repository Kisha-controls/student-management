<div class="grid sm:grid-cols-2 gap-5">
    <div>
        <label class="label" for="code">Course code</label>
        <input class="field" id="code" name="code" value="{{ old('code', $course->code ?? '') }}" required>
        @error('code')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="credit_units">Credit units</label>
        <input class="field" type="number" min="1" max="10" id="credit_units" name="credit_units" value="{{ old('credit_units', $course->credit_units ?? 3) }}" required>
        @error('credit_units')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="label" for="title">Title</label>
        <input class="field" id="title" name="title" value="{{ old('title', $course->title ?? '') }}" required>
        @error('title')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="sm:col-span-2">
        <label class="label" for="description">Description</label>
        <textarea class="field" id="description" name="description" rows="3">{{ old('description', $course->description ?? '') }}</textarea>
        @error('description')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="capacity">Capacity (seats)</label>
        <input class="field" type="number" min="1" max="500" id="capacity" name="capacity" value="{{ old('capacity', $course->capacity ?? 50) }}" required>
        @error('capacity')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="label" for="lecturer_id">Lecturer</label>
        <select class="field" id="lecturer_id" name="lecturer_id">
            <option value="">— Not assigned —</option>
            @foreach ($lecturers as $l)<option value="{{ $l->id }}" @selected(old('lecturer_id', $course->lecturer_id ?? '') == $l->id)>{{ $l->name }}</option>@endforeach
        </select>
        @error('lecturer_id')<p class="field-error">{{ $message }}</p>@enderror
    </div>
</div>
