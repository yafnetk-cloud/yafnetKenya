<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ImpactStatController;
use App\Http\Controllers\Admin\JobPostingController;
use App\Http\Controllers\Admin\FormSubmissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::post('/donate', [DonationController::class, 'initiate'])
    ->name('donate.initiate');

Route::post('/palpluss/callback', [DonationController::class, 'callback'])
    ->name('palpluss.callback');
Route::get('/programs', [PageController::class, 'programsIndex'])->name('programs.index');
Route::get('/programs/{program:slug}', [PageController::class, 'programShow'])->name('programs.show');
Route::get('/flagship-programs', [PageController::class, 'flagshipIndex'])->name('flagship.index');

Route::get('/where-we-work', [PageController::class, 'whereWeWork'])->name('where-we-work');

Route::get('/news', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{post:slug}', [PageController::class, 'newsShow'])->name('news.show');

Route::get('/partners', [PageController::class, 'partners'])->name('partners');

Route::get('/get-involved', [PageController::class, 'getInvolved'])->name('get-involved');
Route::post('/get-involved/volunteer', [PageController::class, 'submitVolunteer'])->name('volunteer.submit');
Route::post('/get-involved/partner-inquiry', [PageController::class, 'submitPartnerInquiry'])->name('partner-inquiry.submit');

Route::get('/governance', [PageController::class, 'governance'])->name('governance');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

Route::post('/newsletter', [PageController::class, 'newsletter'])->name('newsletter.submit');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::middleware(['auth', \App\Http\Middleware\EnsureAdmin::class])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('news', NewsPostController::class)->except(['show'])->parameters(['news' => 'post']);
        Route::resource('partners', PartnerController::class)->except(['show']);
        Route::resource('team', TeamMemberController::class)->except(['show'])->parameters(['team' => 'member']);
        Route::resource('programs', ProgramController::class)->except(['show']);
        Route::resource('stats', ImpactStatController::class)->except(['show']);
        Route::resource('jobs', JobPostingController::class)->except(['show']);

        Route::get('submissions', [FormSubmissionController::class, 'index'])->name('submissions.index');
        Route::get('submissions/export', [FormSubmissionController::class, 'export'])->name('submissions.export');
        Route::get('submissions/{submission}', [FormSubmissionController::class, 'show'])->name('submissions.show');
        Route::delete('submissions/{submission}', [FormSubmissionController::class, 'destroy'])->name('submissions.destroy');

        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('media/{item}', [MediaController::class, 'destroy'])->name('media.destroy');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::middleware(\App\Http\Middleware\EnsureSuperAdmin::class)->group(function () {
            Route::get('users', [UserController::class, 'index'])->name('users.index');
            Route::get('users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('users', [UserController::class, 'store'])->name('users.store');
            Route::delete('users/{editUser}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });
});
