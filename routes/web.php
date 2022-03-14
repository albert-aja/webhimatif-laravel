<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\WebAjaxController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;

//Web
Route::controller(WebController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/Divisi/{division:slug}', 'divisi')->name('web-division');
    Route::get('/Himatif_Shop', 'himatif_shop')->name('web-himatifshop');
    Route::get('/Berita', 'berita')->name('web-news');
    Route::get('/Artikel/{post:slug}', 'article')->name('web-article');
});

//Web Ajax
Route::controller(WebAjaxController::class)->group(function (){
    Route::get('/ajax_request/item_modal/{id}', 'call_modal')->name('ajax-itemmodal');
    Route::get('/ajax_request/load_post', 'load_post')->name('ajax-loadpost');
    Route::get('/ajax_request/search_title', 'search_title')->name('ajax-searchpost');
});

//Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('/Login', 'index')->name('auth-login');
    Route::post('/Login', 'attemptLogin')->name('auth-attempt');
    Route::post('/logout', 'logout')->name('auth-logout');
});

Route::controller(RegisterController::class)->middleware('allowRegis')->group(function () {
    Route::get('/Register', 'index')->name('auth-register');
    Route::post('/Register', 'attemptRegister')->name('auth-registration');
});

Route::controller(VerifyEmailController::class)->middleware('guest')->group(function () {
    Route::get('/VerifyEmail', 'index')->name('auth-verify');
    Route::get('/activate_account/{token}', 'attemptActivation')->name('auth-activeaccount');
    Route::get('/resend_email/{email}', 'resendEmail')->name('auth-resendEmail');
});

Route::controller(ForgotPasswordController::class)->middleware('guest')->group(function () {
    Route::get('/ForgotPassword', 'index')->name('auth-forgot');
});

//Admin
Route::prefix('Admin')->middleware(['isActive', 'auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function() {
        Route::get('Dashboard', 'index')->name('admin-dashboard');
    });
    Route::resource('Division', DivisionController::class);
});
