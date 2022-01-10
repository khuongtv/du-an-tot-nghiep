<?php

use App\Http\Controllers\Client\Company\ApplysController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * API
 */
Route::post('danh-sach-tim-kiem-cong-viec', [HomeController::class, 'listBlog'])->name('list_blog');
Route::post('yeu-thich', [HomeController::class, 'favorite'])->name('post_favorite');
Route::post('chi-tiet-ung-tuyen/{id}', [HomeController::class, 'applyDetail'])->name('apply_detail');

Route::POST('them-ghi-chu', [ApplysController::class, 'addNote'])->name('note');
Route::GET('ghi-chu/{id}', [ApplysController::class, 'listNote'])->name('listnote');
Route::POST('xoa-ghi-chu', [ApplysController::class, 'deleteNote'])->name('delete.listnote');
Route::GET('gui-mail/{apply_id}/{company}', [HomeController::class, 'alert'])->name('sendmail');
Route::POST('sap-xep-tin-tuyen-dung', [HomeController::class, 'sortBy'])->name('sortby');
Route::GET('noi-dung-don/{id}', [HomeController::class, 'getMessApply'])->name('mess');
