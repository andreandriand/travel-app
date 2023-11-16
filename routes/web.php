<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TravelPackageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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


Route::get('detail/{slug}', [HomeController::class, 'show'])->name('home.detail');

Route::get('checkout/{id}', [CheckoutController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('checkout.package');
Route::post('checkout/{id}', [CheckoutController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('checkout.process');
Route::post('checkout/create/{id}', [CheckoutController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('checkout.create');
Route::get('checkout/remove/{detail_id}', [CheckoutController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('checkout.remove');
Route::get('checkout/confirm/{id}', [CheckoutController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('checkout.success');

Route::get('/success', function () {
    return view('pages.frontend.success');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('dashboard.profile');

    Route::resource('travel-package', TravelPackageController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('transaction', TransactionController::class);
});

Route::post('profile', [AuthController::class, 'VerifyEmail'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


// Midtrans

Route::post('midtrans/callback', [MidtransController::class, 'notificationHandler'])->name('midtrans.callback');
Route::get('midtrans/finish', [MidtransController::class, 'finishRedirect'])->name('midtrans.finish');
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinishRedirect'])->name('midtrans.unfinish');
Route::get('midtrans/error', [MidtransController::class, 'errorRedirect'])->name('midtrans.error');
