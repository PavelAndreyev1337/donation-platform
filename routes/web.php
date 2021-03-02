<?php

use App\Http\Controllers\Api\V1\DonationController;
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

Route::get("/", function () {
    return view("index");
});

Route::group(["prefix" => "/api/v1"], function () {
    Route::resource("/donations", DonationController::class)->only([
        "index", "store"
    ]);
});
