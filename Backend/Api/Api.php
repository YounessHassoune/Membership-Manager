<?php

namespace App\Api;

use App\controllers\User;
use App\controllers\Company;
use App\controllers\Plan;
use App\route\Route;
//---------------Api Routing---------------


//=============user route====================================
Route::post('user/register', [User::class, 'register']);
Route::post('user/login', [User::class, 'login']);
Route::post('user/update', [User::class, 'update']);
Route::get('user/info', [User::class, 'info']);
//=============user route====================================
Route::post('company/register', [Company::class, 'register']);
Route::post('company/login', [Company::class, 'login']);
Route::get('company/info', [Company::class, 'info']);
//=============plans route===================================
Route::post('plan/create', [Plan::class, 'create']);
Route::post('plan/reserve', [Plan::class, 'reserve']);
Route::get('plan/stats', [Plan::class, 'stats']);
