<?php

use App\Libraries\Route;

use App\Controllers\UserController;
use App\Controllers\StateController;
use App\Controllers\CityController;
use App\Controllers\StreetController;
use App\Controllers\AddressController;


/**
 * Controlador de rotas onde são registradas todas as rotas da aplicação
 */

// Rotas de User (Usuário)
Route::get('/api/users/:id', UserController::class, 'index');
Route::post('/api/users', UserController::class, 'store');
Route::put('/api/users/:id', UserController::class, 'update');
Route::delete('/api/users/:id', UserController::class, 'destroy');

// Rotas de State (Estado)
Route::get('/api/states/:id', StateController::class, 'index');
Route::post('/api/states', StateController::class, 'store');
Route::put('/api/states/:id', StateController::class, 'update');
Route::delete('/api/states/:id', StateController::class, 'destroy');

// Rotas de City (Cidade)
Route::get('/api/cities/:id', CityController::class, 'index');
Route::post('/api/cities', CityController::class, 'store');
Route::put('/api/cities/:id', CityController::class, 'update');
Route::delete('/api/cities/:id', CityController::class, 'destroy');

// Rotas de Street (Rua)
Route::get('/api/streets/:id', StreetController::class, 'index');
Route::post('/api/streets', StreetController::class, 'store');
Route::put('/api/streets/:id', StreetController::class, 'update');
Route::delete('/api/streets/:id', StreetController::class, 'destroy');

// Rotas de Address (Endereço)
Route::get('/api/addresses/:id', AddressController::class, 'index');
Route::post('/api/addresses', AddressController::class, 'store');
Route::put('/api/addresses/:id', AddressController::class, 'update');
Route::delete('/api/addresses/:id', AddressController::class, 'destroy');