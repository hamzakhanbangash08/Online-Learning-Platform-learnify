<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CourseController, LessonController, EnrollmentController, CheckoutController};

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    // Courses (browse for all; create/update only instructor/admin)
    Route::resource('courses', CourseController::class);

    // Lessons (only for course owner/admin)
    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

    Route::resource('lessons', LessonController::class);

    // Enroll
    Route::resource('enrollments', EnrollmentController::class)->only(['store', 'destroy']);
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

    // Checkout (Stripe)
    Route::post('courses/{course}/checkout', [CheckoutController::class, 'checkout'])->name('checkout.course');
    Route::get('payments/success', [CheckoutController::class, 'success'])->name('payments.success');
    Route::get('payments/cancel', [CheckoutController::class, 'cancel'])->name('payments.cancel');
});
