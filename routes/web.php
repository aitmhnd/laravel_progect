<?php

use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('create');
});


Route::get('/home','homeController@index')->name('home');

Route::get('/post/{id}','homeController@show')->name('post.show');
Route::get('/create/post','homeController@create')->name('post.create');
Route::post('/add/post','homeController@store')->name('post.store');
Route::get('/edit/post/{slug}','homeController@edit')->name('post.edit');
Route::put('/update/post/{slug}','homeController@update')->name('post.update');
Route::delete('/delete/post/{slug}','homeController@delete')->name('post.delete');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/home');
    });
});
