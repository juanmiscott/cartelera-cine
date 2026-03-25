<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::group(['prefix' => 'admin' , 'middleware' => 'auth:web' ], function () { 

  Route::post('/images', 'App\Http\Controllers\Admin\ImageController@store')->name('images_store');
  Route::get('/images/thumb/{filename}', 'App\Http\Controllers\Admin\ImageController@showThumb')->name('images_thumb');
  Route::delete('/images/{filename}', 'App\Http\Controllers\Admin\ImageController@destroy')->name('images_destroy');
  Route::get('/images-gallery-refresh', 'App\Http\Controllers\Admin\ImageController@refreshGallery')->name('images_refresh'); 
   
  Route::get('/panel-de-control', function () {
      return view('admin.dashboard.index');
  })->name('dashboard');

  Route::resource('usuarios', 'App\Http\Controllers\Admin\UserController', [
    'parameters' => [
      'usuarios' => 'user',
    ],
    'names' => [
      'index' => 'users',
      'create' => 'users_create',
      'edit' => 'users_edit',
      'store' => 'users_store',
      'update' => 'users_update',
      'destroy' => 'users_destroy',
    ]
  ]);

  Route::resource('peliculas', 'App\Http\Controllers\Admin\MovieController', [
    'parameters' => [
      'peliculas' => 'movie',
    ],
    'names' => [
      'index' => 'movies',
      'create' => 'movies_create',
      'edit' => 'movies_edit',
      'store' => 'movies_store',
      'destroy' => 'movies_destroy',
      'update' => 'movies_update',
    ]
  ]);

  Route::resource('categorias', 'App\Http\Controllers\Admin\FilmCategoryController', [
    'parameters' => [
      'categorias' => 'film_category',
    ],
    'names' => [
      'index' => 'film_categories',
      'create' => 'film_categories_create',
      'edit' => 'film_categories_edit',
      'store' => 'film_categories_store',
      'destroy' => 'film_categories_destroy',
      'update' => 'film_categories_update',
    ]
  ]);

    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
    'parameters' => [
      'faqs' => 'faq',
    ],
    'names' => [
      'index' => 'faqs',
      'create' => 'faqs_create',
      'edit' => 'faqs_edit',
      'store' => 'faqs_store',
      'destroy' => 'faqs_destroy',
      'update' => 'faqs_update',
    ]
  ]);



 
});

Route::group(['prefix' => 'cuenta' , 'middleware' => 'auth:customer'], function () { 
  Route::get('/panel-de-control', function () {
      return view('customer.dashboard.index');
  })->name('customer-dashboard');
});

Route::group(['middleware' => 'getSitemap'], function () {
  Route::get('/es', 'App\Http\Controllers\Public\HomeController@index')->name('es.home');
  Route::get('/es/peliculas/{title}', 'App\Http\Controllers\Public\MovieController@show')->name('es.movie');

  Route::get('/en', 'App\Http\Controllers\Public\HomeController@index')->name('en.home');
  Route::get('/en/movies/{title}', 'App\Http\Controllers\Public\MovieController@show')->name('en.movie');
});

Route::post('/language', 'App\Http\Controllers\Public\LanguageController@changeLanguage')->name('language.change');
Route::get('/images/{entity}/{entityId}/{filename}', 'App\Http\Controllers\Public\ImageController@showImage')->name('image');

Route::get('/', function () {})->middleware('setLocale');

require __DIR__.'/auth.php';
require __DIR__.'/auth-customer.php';

