<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebAjaxController;
use App\Http\Controllers\Admin\AdminController;

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

Route::controller(AdminController::class)->group(function () {
    Route::get('/Login', 'index')->name('admin-login');
});
