<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = ['user_id', 'student_number', 'name', 'email', 'phone', 'programme', 'year_of_study'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Courses this student is registered for (many-to-many through course_registrations). */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_registrations')
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }
}
