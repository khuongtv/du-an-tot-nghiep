<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\UserCandidateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRecruitmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

/**
 * Route general
 */
Route::get('dang-nhap', [AuthController::class, 'login'])->name('admin_login');
Route::post('dang-nhap', [AuthController::class, 'postLogin']);
Route::get('dang-xuat', [AuthController::class, 'logout'])->name('admin_logout');
Route::get('doi-mat-khau', [AuthController::class, 'changePassword'])->name('admin_change_password');
Route::post('doi-mat-khau', [AuthController::class, 'PostChangePassword']);
Route::get('quen-mat-khau', [AuthController::class, 'forgotPassword'])->name('admin_forgot_password');
Route::post('quen-mat-khau', [AuthController::class, 'PostForgotPassword']);
// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::group([
    'middleware' => ['role_admin'],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::prefix('tin-tuyen-dung')->group(function () {
        Route::get('cac-tin-da-duyet', [BlogController::class, 'listActive'])->name('blog.listActive');
        Route::get('cac-tin-chua-duyet', [BlogController::class, 'listUnactive'])->name('blog.listUnactive');
        Route::get('xem-chi-tiet/{id}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('xoa/{id}', [BlogController::class, 'delete'])->name('blog.delete');
        Route::get('/duyet-tin/{blog_id}', [BlogController::class, 'activeBlog'])->name('blog.activeBlog');
        Route::get('/huy-duyet-tin/{blog_id}', [BlogController::class, 'unactiveBlog'])->name('blog.unactiveBlog');
    });
    Route::prefix('tu-khoa')->group(function () {
        Route::get('/', [KeywordController::class, 'index'])->name('keyword.index');
        Route::get('them-tu-khoa', [KeywordController::class, 'add'])->name('keyword.add');
        Route::post('them', [KeywordController::class, 'store'])->name('keyword.store');
        Route::get('sua-tu-khoa/{id}', [KeywordController::class, 'edit'])->name('keyword.edit');
        Route::post('sua/{id}', [KeywordController::class, 'update'])->name('keyword.update');
        Route::get('xoa/{id}', [KeywordController::class, 'delete'])->name('keyword.delete');
    });
    Route::prefix('slide-quang-cao')->group(function () {
        Route::get('/', [AdsController::class, 'index'])->name('ads.index');
        Route::get('them', [AdsController::class, 'add'])->name('ads.add');
        Route::post('them', [AdsController::class, 'store'])->name('ads.store');
        Route::get('sua/{id}', [AdsController::class, 'edit'])->name('ads.edit');
        Route::post('sua/{id}', [AdsController::class, 'update'])->name('ads.update');
        Route::get('xoa/{id}', [AdsController::class, 'delete'])->name('ads.delete');
    });
    Route::prefix('danh-muc')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('them', [CategoryController::class, 'add'])->name('categories.add');
        Route::post('them', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('sua/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('sua/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/hien-thi-danh-muc/{cate_id}', [CategoryController::class, 'ActiveCate'])->name('categories.ActiveCate');
        Route::get('/an-danh-muc/{cate_id}', [CategoryController::class, 'UnActiveCate'])->name('categories.UnActiveCate');
    });
    Route::prefix('tinh-thanh-pho')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('location.index');
    });
    Route::prefix('cap-nhat-giao-dien')->middleware('role_admin_200')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/', [SettingController::class, 'update'])->name('setting.update');
    });
    Route::prefix('tai-khoan')->middleware('role_admin_200')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('xoa/{user}', [UserController::class, 'destroy'])->name('users.delete');
        Route::post('/update/{id}', [UserController::class, 'updated'])->name('users.updated');
    });
    Route::prefix('tai-khoan-admin')->group(function () {
        Route::get('/', [UserAdminController::class, 'index'])->name('user-admin.index');
    });
    Route::prefix('tai-khoan-ung-vien')->group(function () {
        Route::get('/', [UserCandidateController::class, 'index'])->name('candidate.index');
    });
    Route::prefix('tai-khoan-nha-tuyen-dung')->group(function () {
        Route::get('/', [UserRecruitmentController::class, 'index'])->name('recruitment.index');
    });
    Route::prefix('nhung-danh-gia')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('review.index');
        Route::get('them', [ReviewController::class, 'create'])->name('review.create');
        Route::post('them', [ReviewController::class, 'store'])->name('review.store');
        Route::get('sua/{id}', [ReviewController::class, 'edit'])->name('review.edit');
        Route::post('sua/{id}', [ReviewController::class, 'update'])->name('review.update');
        Route::get('xoa/{id}', [ReviewController::class, 'delete'])->name('review.delete');
    });
    Route::post('check-email', [UserController::class, 'checkEmail'])->name('check.email');

    //Detail recruitment

    Route::post('show-recruitment', [UserRecruitmentController::class, 'showRecruitment'])->name('show.recruitment');

    /**
     * User recruitment
     */
    Route::post('on-tick', [UserRecruitmentController::class, 'onTick'])->name('on.tick');
    Route::post('off-tick', [UserRecruitmentController::class, 'offTick'])->name('off.tick');
});
