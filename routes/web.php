<?php

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
    return view('welcome');
})->name('home');
/*
Route::get('/test', function () {
    return view('Hola Mundo');
});

Route::get('/hola/{nombre?}', function ($nombre = 'Invitado') {
    return "Hola $nombre, <a href=". route('nosotros') ."> conócenos.</a>";
});

Route::get('/nosotros', function () {
    return "<h1>Toda la informacion sobre nosotros</h1>";
})->name('nosotros');

Route::get('home/{nombre?}/{apellido?}', function($nombre = "Pepe", $apellido = "Cruz"){
   $posts = ["Posts1", "Posts2", "Posts3", "Posts4"];
    $posts2 = [];

    return view('home')->with([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'posts' => $posts,
        'posts2' => $posts2
    ]);
})
    ->name("home");*/

Route::resource( 'dashboard/post', 'PostController');

Route::resource( 'dashboard/category', 'dashboard\CategoryController');

Route::resource( 'dashboard/user', 'dashboard\UserController');

Route::post( 'dashboard/post/{post}/image', 'PostController@image')->name('post.image');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
