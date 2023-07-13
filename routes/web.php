<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealTorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
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
Route::get('/',[IndexController::class, 'index']);

Route::get('/hello',[IndexController::class, 'show'])->middleware('auth');

/* Middleware run before the controller action and in case of
the listing resours we want not applly to all route but to specfic route.
middleware('auth') athenticate our app routes.

for this reason we use recourse with except function again.
*/

Route::resource('listing', ListingController::class)
  ->only(['index', 'show'])->withTrashed();

Route::resource('listing.offer', ListingOfferController::class)
->middleware('auth')->only(['store']);

Route::resource('notification', NotificationController::class)
  ->middleware('auth')
  ->only(['index']);

Route::put(
  'notification/{notification}/seen',
  NotificationSeenController::class
)->middleware('auth')->name('notification.seen');

  
Route::get('login', [AuthController::class, 'create']) -> name('login');

Route::post('login', [AuthController::class, 'store']) -> name('login.store');

Route::delete('logout', [AuthController::class, 'destroy']) -> name('logout');

Route::get('/email/verify', function () {
  return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');
// Laravel automaticlly redirect un authenticate users to verification.notice route


Route::resource('user-account', UserAccountController::class)
->only('create', 'store');

Route::prefix('realtor')
->name('realtor.')
->middleware(['auth', 'verified'])
->group(function () {

  Route::name('listing.restore')
      ->put(
        'listing/{listing}/restore',
        [RealtorListingController::class, 'restore']
      )->withTrashed();

  Route::resource('listing', RealTorListingController::class)
    //->only('index', 'destroy','edit', 'update', 'create', 'store')
    ->withTrashed();

    // put() we are to modifying an existing resource not creating anything. modifying an offer
    // for modifying we are using put or patch
    Route::name('offer.accept')->put('offer/{offer}/accept', RealtorListingAcceptOfferController::class);

    Route::resource('listing.image', RealtorListingImageController::class)
    ->only('create', 'store', 'destroy');
  });