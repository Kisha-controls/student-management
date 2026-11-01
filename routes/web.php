<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// ---------- Public pages ----------
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ---------- Guests only ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ---------- Authenticated users ----------
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Students (administrator)
    Route::controller(StudentController::class)->prefix('students')->name('students.')->group(function () {
        Route::get('/create', 'create')->middleware('permission:create students')->name('create');
        Route::post('/', 'store')->middleware('permission:create students')->name('store');
        Route::get('/', 'index')->middleware('permission:view students')->name('index');
        Route::get('/{student}', 'show')->middleware('permission:view students')->name('show');
        Route::get('/{student}/edit', 'edit')->middleware('permission:edit students')->name('edit');
        Route::put('/{student}', 'update')->middleware('permission:edit students')->name('update');
        Route::delete('/{student}', 'destroy')->middleware('permission:delete students')->name('destroy');
    });

    // Courses (admin manages, students browse, lecturers see their own)
    Route::controller(CourseController::class)->prefix('courses')->name('courses.')->group(function () {
        Route::get('/create', 'create')->middleware('permission:create courses')->name('create');
        Route::post('/', 'store')->middleware('permission:create courses')->name('store');
        Route::get('/', 'index')->middleware('permission:view courses|view assigned courses')->name('index');
        Route::get('/{course}', 'show')->middleware('permission:view courses|view assigned courses')->name('show');
        Route::get('/{course}/edit', 'edit')->middleware('permission:edit courses')->name('edit');
        Route::put('/{course}', 'update')->middleware('permission:edit courses')->name('update');
        Route::delete('/{course}', 'destroy')->middleware('permission:delete courses')->name('destroy');
    });

    // Course registrations
    Route::controller(RegistrationController::class)->prefix('registrations')->name('registrations.')->group(function () {
        Route::get('/create', 'create')->middleware('permission:manage registrations')->name('create');
        Route::get('/', 'index')->middleware('permission:view registrations|view own registrations')->name('index');
        Route::post('/', 'store')->middleware('permission:manage registrations|register courses')->name('store');
        Route::delete('/{registration}', 'destroy')->middleware('permission:manage registrations|register courses')->name('destroy');
    });

    // User access management (administrator)
    Route::middleware('permission:manage users')->prefix('admin')->group(function () {
        Route::resource('users', UserController::class)->except('show');
    });
});
