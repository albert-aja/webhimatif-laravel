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
    Route::controller(DivisionController::class)->group(function() {
        Route::get('Division', 'index')->name('division-data');
        Route::get('Division/create', 'create');
        Route::post('Division/store', 'store');
        Route::post('Division/edit', 'edit');
        Route::put('Division/update', 'update');
        Route::delete('Division/destroy', 'destroy');
    });
    Route::controller(CommiteeController::class)->group(function() {
        Route::get('Commitee/{division:slug}', 'index')->name('commitee-data');
        Route::get('Commitee/{division:slug}/create', 'create')->name('commitee-create');
        Route::post('Commitee/{division:slug}/store', 'store')->name('commitee-store');
        Route::get('Commitee/{division:slug}/edit/{commitee:id}', 'edit')->name('commitee-edit');
        Route::post('Commitee/{division:slug}/update/{commitee:id}', 'update')->name('commitee-update');
        Route::delete('Commitee/{division:slug}/destroy', 'destroy');
    });
    Route::controller(PositionController::class)->group(function() {
        Route::get('Position', 'index')->name('position-data');
        Route::get('Position/create', 'create');
        Route::post('Position/store', 'store');
        Route::get('Position/edit/{id}', 'edit');
        Route::post('Position/update', 'update');
        Route::post('Position/destroy', 'destroy');
        Route::get('Position/fetch_new', 'getNewPosition');
    });
    Route::controller(WorkProgramController::class)->group(function() {
        Route::get('Program/{division:slug}', 'index')->name('program-data');
        Route::get('Program/{division:slug}/create', 'create');
        Route::post('Program/{division:slug}/store', 'store');
        Route::post('Program/{division:slug}/edit', 'edit');
        Route::put('Program/{division:slug}/update', 'update');
        Route::delete('Program/{division:slug}/destroy', 'destroy');
    });
    Route::controller(PositionController::class)->group(function() {
        Route::get('Position', 'index')->name('position-data');
        Route::get('Position/create', 'create');
        Route::post('Position/store', 'store');
        Route::post('Position/edit', 'edit');
        Route::put('Position/update', 'update');
        Route::delete('Position/destroy', 'destroy');
    });
    Route::resource('Post', PostController::class, [
                        'names' => [
                            'index'     =>  'post-data',
                            'create'    =>  'post-create',
                            'store'     =>  'post-store',
                            'edit'      =>  'post-edit',
                            'update'    =>  'post-update',
                            'destroy'   =>  'post-delete',
                        ]
                    ]);
    Route::get('postDetail', [PostController::class, 'postDetail']);
    Route::resource('ShopItem', ShopItemController::class, [
                        'names' => [
                            'index'     => 'shop-data',
                            'create'    => 'shop-create',
                            'edit'      => 'shop-edit',
                            'destroy'   => 'shop-delete',
                        ]
                    ]);
    Route::resource('ProductCategory', ProductCategoryController::class, [
                        'names' => [
                            'index'     => 'category-data',
                            'create'    => 'category-create',
                            'edit'      => 'category-edit',
                            'destroy'   => 'category-delete',
                        ]
                    ]);
    Route::resource('ProductColor', ProductColorController::class, [
                        'names' => [
                            'index'     => 'color-data',
                            'create'    => 'color-create',
                            'edit'      => 'color-edit',
                            'destroy'   => 'color-delete',
                        ]
                    ]);
    Route::resource('UMContact', UMContactController::class, [
                        'names' => [
                            'index'     => 'umcontact-data',
                            'create'    => 'umcontact-create',
                            'edit'      => 'umcontact-edit',
                            'destroy'   => 'umcontact-delete',
                        ]
                    ]);
    Route::resource('WorkProgram', WorkProgramController::class, [
                        'names' => [
                            'create'    => 'progja-create',
                            'edit'      => 'progja-edit',
                            'destroy'   => 'progja-delete',
                        ]
                    ])->except(['index']);
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
                                'destroy' => 'mission-delete',
                            ]
                        ]);
        Route::resource('Service', ServiceController::class, [
                            'names' => [
                                'index'  => 'service-data',
                                'create' => 'service-create',
                                'edit'   => 'service-edit',
                                'destroy' => 'service-delete',
                            ]
                        ]);
        Route::resource('SocialMedia', SocialMediaController::class, [
                            'names' => [
                                'index'  => 'socialmedia-data',
                                'create' => 'socialmedia-create',
                                'edit'   => 'socialmedia-edit',
                                'destroy' => 'socialmedia-delete',
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
