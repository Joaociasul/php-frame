<?php

use App\Controllers\Api\Auth\LoginController;
use App\Router\Route;

Route::get('test/{id}', LoginController::class, 'login');