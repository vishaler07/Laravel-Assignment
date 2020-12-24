<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminLogin;

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

Route::get('/home', function(){
    return view('posts.postpage');
})->name('postsview');

Route::get('/admin/home', 'App\Http\Controllers\AdminController@index')->middleware('AdminLogin');

Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::resource('admin/posts','App\Http\Controllers\PostsController')->middleware('AdminLogin');

Route::resource('posts','App\Http\Controllers\PostsController');
