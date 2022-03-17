<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\WebAjaxController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ShopItemController;
use App\Http\Controllers\Admin\UMContactController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\WorkProgramController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\CommiteeController;
use App\Http\Controllers\Admin\ManagementYearController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\FeatureController;

//Web
Route::controller(WebController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('Divisi/{division:slug}', 'divisi')->name('web-division');
    Route::get('Himatif_Shop', 'himatif_shop')->name('web-himatifshop');
    Route::get('Berita', 'berita')->name('web-news');
    Route::get('Artikel/{post:slug}', 'article')->name('web-article');
});

//Web Ajax
Route::controller(WebAjaxController::class)->group(function (){
    Route::get('ajax_request/item_modal/{id}', 'call_modal')->name('ajax-itemmodal');
    Route::get('ajax_request/load_post', 'load_post')->name('ajax-loadpost');
    Route::get('ajax_request/search_title', 'search_title')->name('ajax-searchpost');
});

//Auth
Route::controller(LoginController::class)->group(function () {
    Route::get('Login', 'index')->name('auth-login');
    Route::post('Login', 'attemptLogin')->name('auth-attempt');
    Route::post('logout', 'logout')->name('auth-logout');
});

Route::controller(RegisterController::class)->middleware('allowRegis')->group(function () {
    Route::get('Register', 'index')->name('auth-register');
    Route::post('Register', 'attemptRegister')->name('auth-registration');
});

Route::controller(VerifyEmailController::class)->middleware('guest')->group(function () {
    Route::get('VerifyEmail', 'index')->name('auth-verify');
    Route::get('activate_account/{token}', 'attemptActivation')->name('auth-activeaccount');
    Route::get('resend_email/{email}', 'resendEmail')->name('auth-resendEmail');
});

Route::controller(ForgotPasswordController::class)->middleware('guest')->group(function () {
    Route::get('ForgotPassword', 'index')->name('auth-forgot');
});

//Admin
Route::prefix('Admin')->middleware(['isActive', 'auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function() {
        Route::get('Dashboard', 'index')->name('admin-dashboard');
        Route::get('dashboard_ajax/newsDateRange', 'newsDateRange');
        Route::get('dashboard_ajax/newsStatChart', 'newsStatChart');
        Route::get('dashboard_ajax/latestNews', 'latestNews');
        Route::get('dashboard_ajax/topNews', 'topNews');
        Route::get('dashboard_ajax/anggotaHimatif', 'anggotaHimatif');
        Route::get('dashboard_ajax/anggotaHimatifChart', 'anggotaHimatifChart');
        Route::get('dashboard_ajax/postByDivision', 'postByDivision');
        Route::get('dashboard_ajax/postByDivisionChart', 'postByDivisionChart');
        Route::get('dashboard_ajax/shopProduct', 'shopProduct');
        Route::get('dashboard_ajax/shopProductChart', 'shopProductChart');
    });
    Route::resource('Commitee', CommiteeController::class, [
                        'names' => [
                            'index'  => 'commitee-data',
                            'create' => 'commitee-create',
                            'edit'   => 'commitee-edit',
                            'delete' => 'commitee-delete',
                        ]
                    ]);
    Route::resource('Division', DivisionController::class, [
                        'names' => [
                            'index'  => 'division-data',
                            'create' => 'division-create',
                            'edit'   => 'division-edit',
                            'delete' => 'division-delete',
                        ]
                    ]);
    Route::resource('Position', PositionController::class, [
                        'names' => [
                            'index'  => 'position-data',
                            'create' => 'position-create',
                            'edit'   => 'position-edit',
                            'delete' => 'position-delete',
                        ]
                    ]);
    Route::resource('Post', PostController::class, [
                        'names' => [
                            'index'  => 'post-data',
                            'create' => 'post-create',
                            'edit'   => 'post-edit',
                            'delete' => 'post-delete',
                        ]
                    ]);
    Route::resource('ShopItem', ShopItemController::class, [
                        'names' => [
                            'index'  => 'shop-data',
                            'create' => 'shop-create',
                            'edit'   => 'shop-edit',
                            'delete' => 'shop-delete',
                        ]
                    ]);
    Route::resource('ProductCategory', ProductCategoryController::class, [
                        'names' => [
                            'index'  => 'category-data',
                            'create' => 'category-create',
                            'edit'   => 'category-edit',
                            'delete' => 'category-delete',
                        ]
                    ]);
    Route::resource('ProductColor', ProductColorController::class, [
                        'names' => [
                            'index'  => 'color-data',
                            'create' => 'color-create',
                            'edit'   => 'color-edit',
                            'delete' => 'color-delete',
                        ]
                    ]);
    Route::resource('UMContact', UMContactController::class, [
                        'names' => [
                            'index'  => 'umcontact-data',
                            'create' => 'umcontact-create',
                            'edit'   => 'umcontact-edit',
                            'delete' => 'umcontact-delete',
                        ]
                    ]);
    Route::resource('WorkProgram', WorkProgramController::class, [
                        'names' => [
                            'index'  => 'progja-data',
                            'create' => 'progja-create',
                            'edit'   => 'progja-edit',
                            'delete' => 'progja-delete',
                        ]
                    ]);
    Route::prefix('Config')->group(function () {
        Route::resource('History', HistoryController::class, [
                            'names' => [
                                'edit'   => 'history-edit',
                            ]
                        ]);
        Route::resource('Year', ManagementYearController::class, [
                            'names' => [
                                'edit'   => 'tahun-edit',
                            ]
                        ]);
        Route::resource('Mission', MissionController::class, [
                            'names' => [
                                'index'  => 'mission-data',
                                'create' => 'mission-create',
                                'edit'   => 'mission-edit',
                                'delete' => 'mission-delete',
                            ]
                        ]);
        Route::resource('Service', ServiceController::class, [
                            'names' => [
                                'index'  => 'service-data',
                                'create' => 'service-create',
                                'edit'   => 'service-edit',
                                'delete' => 'service-delete',
                            ]
                        ]);
        Route::resource('SocialMedia', SocialMediaController::class, [
                            'names' => [
                                'index'  => 'socialmedia-data',
                                'create' => 'socialmedia-create',
                                'edit'   => 'socialmedia-edit',
                                'delete' => 'socialmedia-delete',
                            ]
                        ]);
        Route::resource('Vision', VisionController::class, [
                            'names' => [
                                'edit'   => 'vision-edit',
                            ]
                        ]);
    });
    Route::prefix('Config')->group(function () {
        Route::controller(TruncateController::class)->group(function() {
            Route::get('Truncate', 'index')->name('truncate-data');
            Route::get('getTable', 'getTable')->name('truncate-getdata');
            Route::get('getTableDetail', 'getTableDetail')->name('truncate-tabledetail');
        });
    });
    Route::controller(FeatureController::class)->group(function() {
        Route::get('get_status', 'get_status');
        // Route::post('maintenance_switch/{status}', 'maintenance_switch');
        Route::get('a2m', 'maintenance_mode');
        Route::get('m2a', 'active_mode');
        Route::get('Change_Password', 'change_password')->name('admin-changepassword');
        Route::get('Fresh_Start', 'fresh_start')->name('admin-freshstart');
    });
});
