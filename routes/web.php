<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEnd\AboutUsController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use App\Http\Controllers\FrontEnd\WebsiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookUserController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $categories = Category::get();

    return view('welcome', ['categories' => $categories]);
})->name('welcome');

Auth::routes();

// Route::group(['middleware' => ['guest']], function () {
Route::get('/', [WebsiteController::class, 'website'])->name('website.index');
Route::get('/Books', [FrontEndBookController::class, 'index'])->name('book.post');
Route::get('/Books/{Books}/{slug?}', [FrontEndBookController::class, 'single'])->name('Books.single');
Route::post('/Books/store/{slug?}', [FrontEndBookController::class, 'enroll'])->name('Bookss.enroll');

Route::get('/aboutUs', [AboutUsController::class, 'index'])->name('aboutUs.index');
Route::get('/aboutUs/{slug}', [AboutUsController::class, 'single'])->name('aboutUs.single');

Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contactUs.index');
Route::get('/contactUs/{slug}', [ContactUsController::class, 'single'])->name('contactUs.single');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'single'])->name('news.single');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/users/delet', [userController::class, 'index'])->name('users.index');
    /* Route::get('/book', [BookController::class, 'index'])->name('book.post'); */

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('lessons', LessonController::class);
    Route::get('/lessons/create/{slug}', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/image-upload', [LessonController::class, 'image-upload'])->name('lessons.image-upload');
    // Route::get('lessons', [LessonController::class, 'index'])->name('lessons.index');

    //

    Route::resource('newses', NewsController::class);
    //users
    Route::resource('users', UserController::class)->except('show');
    Route::get('/users/show', [UserController::class, 'show'])->name('users.show');
    Route::resource('users', UserController::class)->except('edit');

    // Students

    Route::resource('/students', StudentController::class)->except('show');
    Route::get('/students/{slug}', "App\Http\Controllers\StudentController@show")->name('students.show');

    //catgegory
    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/show', [CategoryController::class, 'show'])->name('categories.show');


    //Books
    Route::resource('books', BookController::class);



    //bookusers
    Route::resource('bookuser', BookUserController::class);
    Route::get('bookuser/{id}', "App\Http\Controllers\BookUserController@show")->name('bookuser.show');


});
