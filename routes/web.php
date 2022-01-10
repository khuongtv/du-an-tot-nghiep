<?php

use App\Http\Controllers\Client\Company\BlogsController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\Company\ApplysController;
use App\Http\Controllers\Client\Company\CandidatesController;
use App\Http\Controllers\Client\Company\StatisticalController;
use App\Http\Controllers\Client\Company\UserRecruitmentController;
use App\Http\Controllers\Client\HomeController;
use App\Models\Ads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Route auth
 */
Route::get('dang-ky', [AuthController::class, 'signup'])->name('signup');
Route::post('dang-ky', [AuthController::class, 'postSignup']);
Route::get('dang-ky/xac-thuc/{code}', [AuthController::class, 'verify'])->name('sigup.verify');
Route::get('xac-thuc-lai/{id}', [AuthController::class, 'sendMailVery'])->name('sendmai.very');
Route::get('dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('dang-nhap', [AuthController::class, 'postLogin']);
Route::get('dang-xuat', [AuthController::class, 'logout'])->name('logout');
Route::get('doi-mat-khau', [AuthController::class, 'changePassword'])->name('change_password')->middleware('auth');
Route::post('doi-mat-khau', [AuthController::class, 'PostChangePassword']);
Route::get('quen-mat-khau', [AuthController::class, 'forgot'])->name('forgot_password');
Route::post('quen-mat-khau', [AuthController::class, 'forgotPassword']);

/**
 * Route full page general
 */
Route::get('404', [HomeController::class, 'notFound'])->name('404');

/**
 * Route full page candidate
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('tim-kiem', [HomeController::class, 'search'])->name('search');

Route::get('cong-viec/{slug}', [HomeController::class, 'job'])->name('job');
Route::post('cong-viec/{slug}', [HomeController::class, 'postJob']);
Route::get('ung-tuyen-sieu-toc/{user_id}/{blog_id}', [HomeController::class, 'postJobFast'])->name('apply_fast');

Route::get('ung-vien/{id}', [HomeController::class, 'candidate'])->name('candidate');
Route::get('cong-ty/{slug}', [HomeController::class, 'company'])->name('company');

Route::get('cap-nhat-thong-tin', [HomeController::class, 'updateCadidate'])->name('update.candidate');
Route::post('cap-nhat-thong-tin', [HomeController::class, 'PostUpdateCadidate']);
Route::get('quan-ly-cv', [HomeController::class, 'cv'])->name('cv')->middleware('role_candidate');
Route::post('quan-ly-cv', [HomeController::class, 'newCv']);
Route::get('xoa-cv/{id}', [HomeController::class, 'deleteCv'])->name('delete_cv')->middleware('role_candidate');

Route::get('ung-tuyen', [HomeController::class, 'apply'])->name('apply')->middleware('role_candidate');
Route::get('yeu-thich', [HomeController::class, 'jobSave'])->name('favorite')->middleware('role_candidate');
Route::post('lien-he', [HomeController::class, 'contact'])->name('contact');

Route::get('ho-so-ung-vien/{id}', [HomeController::class, 'profile'])->name('profile');

/**
 * Route full page recruitment
 */
Route::group([
    'middleware' => ['role_recruitment','auth'],
],function(){
    Route::prefix('nha-tuyen-dung')->group(function () {
        // Route::get('/', [HomeController::class, 'index'])->name('recruitment.index');
        Route::get('thong-ke',[StatisticalController::class , 'index'])->name('statistical.index');
        Route::post('thong-ke',[StatisticalController::class , 'index']);
        Route::get('quan-ly-tin-tuyen-dung', [BlogsController::class, 'index'])->name('blog.index');
        Route::get('quan-ly-tin-tuyen-dung/xoa/{id}', [BlogsController::class, 'delete'])->name('blog.destroy');
        Route::get('quan-ly-tin-tuyen-dung/tao-moi', [BlogsController::class, 'addForm'])->name('blog.add');
        Route::post('quan-ly-tin-tuyen-dung/tao-moi', [BlogsController::class, 'saveAdd']);
        Route::get('quan-ly-tin-tuyen-dung/cap-nhat/{id}', [BlogsController::class, 'editForm'])->name('blog.edit');
        Route::post('quan-ly-tin-tuyen-dung/cap-nhat/{id}', [BlogsController::class, 'saveEdit']);
        Route::get('tim-kiem-ung-vien', [CandidatesController::class, 'index'])->name('candidatesearch.index');
        Route::get('tim-kiem-ung-vien/xoa{id}', [CandidatesController::class, 'delete'])->name('candidatesearch.delete');
        Route::get('quan-ly-don-ung-tuyen', [ApplysController::class, 'index'])->name('apply.index');
        Route::get('quan-ly-don-ung-tuyen/chi-tiet/{id}', [ApplysController::class, 'detail'])->name('apply.detail');
        Route::get('quan-ly-don-ung-tuyen/sua', [ApplysController::class, 'update'])->name('apply.update');
        Route::get('thong-tin-nha-tuyen-dung/{id}' ,[UserRecruitmentController::class , 'editForm' ])->name('userCompany.edit');
        Route::post('thong-tin-nha-tuyen-dung/{id}' ,[UserRecruitmentController::class , 'saveEdit' ]);
    
    });
});


// Route::get('date', function () {

//     $link_map = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.3436966505915!2d105.81040111424446!3d20.978855594857528!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acef215f424f%3A0xa3cd745e601f84ef!2zxJAuIE5ndXnhu4VuIFhp4buDbiAtIFhhIExhLCDEkOG6oWkgS2ltLCBIb8OgbmcgTWFpLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1638603223679!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
//     preg_match('/src="([^"]+)"/', $link_map, $match);
//     $url = $match[1];
//     echo $url;
//     // echo "<p>". $text ."</p>";
// });
