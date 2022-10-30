<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FrontEnd\AboutUsController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use App\Http\Controllers\FrontEnd\WebsiteController;

use App\Http\Controllers\NewsController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::group(['middleware' => ['guest']], function () {
Route::get('/', [WebsiteController::class, 'website'])->name('website.index');

Route::get('/aboutUs', [AboutUsController::class, 'index'])->name('aboutUs.index');
Route::get('/aboutUs/{slug}', [AboutUsController::class, 'single'])->name('aboutUs.single');

Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contactUs.index');
Route::get('/contactUs/{slug}', [ContactUsController::class, 'single'])->name('contactUs.single');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'single'])->name('news.single');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('roles',   RoleController::class);

    Route::resource('lessons', LessonController::class)->except('create');
    Route::get('/lessons/create/{slug}', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/image-upload', [LessonController::class, 'image-upload'])->name('lessons.image-upload');


    Route::resource('newses', NewsController::class);

    Route::resource('users', UserController::class)->except('show');
    Route::get('/users/{slug}', [UserController::class, 'show'])->name('users.show');

    // Students
    Route::resource('/students', StudentController::class)->except('show');
    Route::get('/students/{slug}', [StudentController::class, 'show'])->name('students.show');


});
