<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\QuizAttemptController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\profileUpdateController;
use App\Http\Controllers\Admin\QuestionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home') // already logged in → home
        : view('auth.login');       // guest → login page
});

// Google login routes
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Auth::routes();

// Certificate verify page is public
Route::get('/certificate/verify/{token}', [CertificateController::class, 'verify'])
    ->name('certificate.verify');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // User home page
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'browseCategory'])->name('home');

    // Route::get('/home', [AdminController::class, 'home'])->name('browse');

    // Courses & Lessons
    Route::resource('courses', CourseController::class);

    // Enrollments & Payments
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::post('courses/{course}/checkout', [CheckoutController::class, 'checkout'])->name('checkout.course');
    Route::get('payments/success', [CheckoutController::class, 'success'])->name('payments.success');
    Route::get('payments/cancel', [CheckoutController::class, 'cancel'])->name('payments.cancel');

    // Quizzes & Certificates
    Route::get('/quiz/{quiz}/start', [QuizAttemptController::class, 'start'])->name('quiz.start');
    Route::post('/quiz/{quiz}/submit', [QuizAttemptController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/attempt/{attempt}/result', [QuizAttemptController::class, 'result'])->name('quiz.result');
    Route::get('/my-results', [QuizAttemptController::class, 'myResults'])->name('quiz.myResults');
    Route::get('/quiz/{attempt}/certificate', [QuizAttemptController::class, 'generateCertificate'])->name('quiz.certificate');
    Route::get('/certificate/{certificate}/download', [QuizAttemptController::class, 'download'])->name('certificate.download');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'checkrole:admin'])->group(function () {


    // category
    Route::resource('/categories', CategoryController::class);
    //course and lessons management
    Route::get('my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
    Route::resource('lessons', LessonController::class);

    // User Management
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('users', [AdminController::class, 'index'])->name('users.index');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('/faq', [AdminController::class, 'faq'])->name('faq');

    // Quiz Management
    Route::resource('quizzes', QuizController::class);
    Route::get('/courses/{course}/quizzes', [QuizController::class, 'quizpage'])->name('course.myquizzes');

    Route::resource('questions', QuestionController::class)->except(['create', 'show', 'edit']);
    Route::resource('options', OptionController::class)->except(['create', 'show', 'edit']);

    Route::prefix('quizzes/{quiz}')->group(function () {
        Route::resource('questions', QuestionController::class)->names('questions');
    });

    Route::prefix('questions/{question}')->group(function () {
        Route::resource('options', OptionController::class)->names('options');
    });

    // Certificate Management
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/export/excel', [CertificateController::class, 'exportExcel'])->name('certificates.export.excel');
    Route::get('/certificates/export/csv', [CertificateController::class, 'exportCsv'])->name('certificates.export.csv');
    Route::get('/certificates/export/pdf', [CertificateController::class, 'exportPdf'])->name('certificates.export.pdf');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/profile', [profileUpdateController::class, 'create'])->name('profile.view');
    Route::post('/profileupdate', [profileUpdateController::class, 'update'])->name('profile.update');
    Route::post('/passwordeupdate', [profileUpdateController::class, 'updatePassword'])->name('profile.updatePassword');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.readAll');

    // My Certificates
    Route::get('/my-certificates', [CertificateController::class, 'index'])->name('certificates.index');

    // leaderboard
    Route::get('/leaderboard', [QuizAttemptController::class, 'leaderboard'])->name('quiz.leaderboard');
});

/*
|--------------------------------------------------------------------------
| Fallback Route (Custom 404 Page)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('admin.error404', [], 404);
});
