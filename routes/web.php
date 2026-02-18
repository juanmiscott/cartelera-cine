<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {

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

  Route::resource('categorias', 'App\Http\Controllers\Admin\FilmCategoriesController', [
    'parameters' => [
      'categorias' => 'filmCategories',
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

  Route::resource('salas', 'App\Http\Controllers\Admin\RoomController', [
  'parameters' => [
    'salas' => 'room',
  ],
  'names' => [
    'index' => 'rooms',
    'create' => 'rooms_create',
    'edit' => 'rooms_edit',
    'store' => 'rooms_store',
    'destroy' => 'rooms_destroy',
    'update' => 'rooms_update',
  ]
]);



  Route::resource('asientos', 'App\Http\Controllers\Admin\SeatController', [
    'parameters' => [
      'asientos' => 'seat',
    ],
    'names' => [
      'index' => 'seats',
      'create' => 'seats_create',
      'edit' => 'seats_edit',
      'store' => 'seats_store',
      'destroy' => 'seats_destroy',
      'update' => 'seats_update',
    ]
  ]);

  Route::resource('tickets', 'App\Http\Controllers\Admin\TicketController', [
  'parameters' => [
    'tickets' => 'ticket',
  ],
  'names' => [
    'index' => 'tickets',
    'create' => 'tickets_create',
    'edit' => 'tickets_edit',
    'store' => 'tickets_store',
    'destroy' => 'tickets_destroy',
    'update' => 'tickets_update',
  ]
]);

Route::resource('sesiones', 'App\Http\Controllers\Admin\SessionController', [
  'parameters' => [
    'sesiones' => 'session',
  ],
  'names' => [
    'index' => 'sessions',
    'create' => 'sessions_create',
    'edit' => 'sessions_edit',
    'store' => 'sessions_store',
    'destroy' => 'sessions_destroy',
    'update' => 'sessions_update',
  ]
]);



});
