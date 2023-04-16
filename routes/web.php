<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DailyUpdateController;



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
    return view('Bloglist');
});


Route::get('/',[ListController::class, 'index']);


Route::get('admin', function () {
    return view('Register');
});

Route::post('store', [UserController::class, 'store'])->name('register');

Route::get('login', function(){
    return view('Login');
})->name('login');

Route::post('check/login', [LoginController::class, 'Checklogin'])->name('Checklogin');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware('checkuserloggedin')->group(function()
{
    Route::get('user/dashboard', [BlogController::class, 'index'])->name('dashboard');
    Route::post('blog/create', [BlogController::class, 'create'])->name('createblog');
    Route::get('blog/show', [BlogController::class, 'show'])->name('showblog');
    Route::get('blog/edit/{slug}', [BlogController::class,'edit'])->name('edit');
    Route::patch('blog/update/{slug}', [BlogController::class,'update'])->name('update');
    Route::delete('blog/delete/{slug}', [BlogController::class,'delete'])->name('delete');
    Route::put('blog/publish/{slug}', [BlogController::class,'publish'])->name('publish');
});

Route::get('sendmail/update', [DailyUpdateController::class, 'Sendmail'])->name('Sendmail');








