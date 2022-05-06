<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\Web\WebAjaxController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\Admin\ManagementYearController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ArticleImageController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\CommiteeController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\WorkProgramController;
use App\Http\Controllers\Admin\ShopItemController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\UMContactController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TruncateController;

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
    Route::get('ajax_request/item_modal/{id}', 'call_modal');
    Route::get('ajax_request/post_total', 'get_total');
    Route::get('ajax_request/load_post', 'load_post');
    Route::get('ajax_request/search_title', 'search_title');
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

    Route::controller(PostController::class)->group(function() {
        Route::get('Post', 'index')->name('post-data');
        Route::get('Post/create', 'create')->name('post-create');
        Route::post('Post/store', 'store');
        Route::post('Post/edit', 'edit')->name('post-edit');
        Route::put('Post/update', 'update');
        Route::delete('Post/destroy', 'destroy');
    });

    Route::controller(ArticleImageController::class)->group(function() {
        Route::get('ArticlePhoto', 'index')->name('article-photos');
        Route::post('ArticlePhoto/upload', 'uploadArticleImage');
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

    Route::controller(ShopItemController::class)->group(function() {
        Route::get('Shop', 'index')->name('shop-data');
        Route::get('Shop/create', 'create');
        Route::post('Shop/store', 'store');
        Route::post('Shop/edit', 'edit');
        Route::post('Shop/update', 'update');
        Route::delete('Shop/destroy', 'destroy');
    });

    Route::controller(ProductGalleryController::class)->group(function() {
        Route::get('ProductGallery', 'rearrangeModal');
        Route::put('ProductGallery/update', 'updateOrder');
    });

    Route::controller(ProductColorController::class)->group(function() {
        Route::get('ProductColor', 'index')->name('color-data');
        Route::get('ProductColor/create', 'create');
        Route::post('ProductColor/store', 'store');
        Route::post('ProductColor/edit', 'edit');
        Route::put('ProductColor/update', 'update');
        Route::delete('ProductColor/destroy', 'destroy');
    });

    Route::controller(ProductCategoryController::class)->group(function() {
        Route::get('ProductCategory', 'index')->name('category-data');
        Route::get('ProductCategory/create', 'create');
        Route::post('ProductCategory/store', 'store');
        Route::post('ProductCategory/edit', 'edit');
        Route::put('ProductCategory/update', 'update');
        Route::delete('ProductCategory/destroy', 'destroy');
    });

    Route::controller(UMContactController::class)->group(function() {
        Route::get('UMContact', 'index')->name('contact-data');
        Route::get('UMContact/create', 'create');
        Route::post('UMContact/store', 'store');
        Route::post('UMContact/edit', 'edit');
        Route::put('UMContact/update', 'update');
        Route::delete('UMContact/destroy', 'destroy');
    });

    Route::prefix('Config')->group(function () {
        Route::controller(HistoryController::class)->group(function() {
            Route::get('History', 'index')->name('config-history');
            Route::put('History/update', 'update');
        });

        Route::controller(ManagementYearController::class)->group(function() {
            Route::get('ManagementYear', 'index')->name('config-year');
            Route::put('ManagementYear/update', 'update');
        });

        Route::controller(VisionController::class)->group(function() {
            Route::get('Vision', 'index')->name('config-vision');
            Route::put('Vision/update', 'update');
        });

        Route::controller(MissionController::class)->group(function() {
            Route::get('Mission', 'index')->name('config-mission');
            Route::get('Mission/create', 'create');
            Route::post('Mission/store', 'store');
            Route::post('Mission/edit', 'edit');
            Route::put('Mission/update', 'update');
            Route::delete('Mission/destroy', 'destroy');
        });

        Route::controller(ServiceController::class)->group(function() {
            Route::get('Service', 'index')->name('config-service');
            Route::get('Service/create', 'create');
            Route::post('Service/store', 'store');
            Route::post('Service/edit', 'edit');
            Route::put('Service/update', 'update');
            Route::delete('Service/destroy', 'destroy');
        });

        Route::controller(SocialMediaController::class)->group(function() {
            Route::get('SocialMedia', 'index')->name('config-socialmedia');
            Route::get('SocialMedia/create', 'create');
            Route::post('SocialMedia/store', 'store');
            Route::post('SocialMedia/edit', 'edit');
            Route::put('SocialMedia/update', 'update');
            Route::delete('SocialMedia/destroy', 'destroy');
        });
    });

    Route::controller(TruncateController::class)->group(function() {
        Route::get('Database', 'index')->name('database-data');
        Route::get('Database/detail', 'getTableDetail');
        Route::post('Database/truncate', 'truncateHandler');
    });

    Route::controller(FeatureController::class)->group(function() {
        Route::get('get_status', 'get_status');
        Route::get('a2m', 'maintenance_mode');
        Route::get('m2a', 'active_mode');
        Route::get('changepw', 'change_password');
        Route::post('editpw', 'edit_password');
        Route::get('Fresh_Start', 'fresh_start')->name('admin-freshstart');
    });
});
