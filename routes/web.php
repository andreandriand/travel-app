<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.admin.index');
});

Route::get('/home', function () {
    return view('pages.frontend.index');
});
Route::get('/detail', function () {
    return view('pages.frontend.details');
});
Route::get('/co', function () {
    return view('pages.frontend.checkout');
});
Route::get('/success', function () {
    return view('pages.frontend.success');
});
