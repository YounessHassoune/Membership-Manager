<?php

namespace App\Api;

use App\controllers\User;

use App\route\Route;
//---------------Api Routing---------------
Route::post('user/register', [User::class, 'register']);
Route::post('user/login', [User::class, 'login']);
Route::post('user/update', [User::class, 'update']);
Route::post('user/test', [User::class, 'test']);
