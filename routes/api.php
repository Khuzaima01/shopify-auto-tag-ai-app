<?php

use App\Http\Controllers\ShopifyController;
use Illuminate\Support\Facades\Route;

Route::get('/install', [ShopifyController::class, 'install']);
Route::get('/auth/callback', [ShopifyController::class, 'callback']);
