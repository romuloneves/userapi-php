<?php

use App\Controllers\UserController;
use App\Libraries\Route;

Route::get('/api/users/:id', UserController::class, 'index');
Route::post('/api/users', UserController::class, 'store');
Route::put('/api/users/:id', UserController::class, 'update');
Route::delete('/api/users/:id', UserController::class, 'destroy');

//$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$api_prefix = '/api';
//
//switch($url)
//{
//    //case '/':
//    //    echo 'abc';
//    //break;
////
//    //case '/adicionar':
//    //    echo 'adicionado';
//    //break;
//
//    case $api_prefix.'/users':
//        UserController::store();
//    break;
//}