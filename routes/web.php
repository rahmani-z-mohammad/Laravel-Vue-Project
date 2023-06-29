<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealTorListingController;
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
  
Route::get('login', [AuthController::class, 'create']) -> name('login');

Route::post('login', [AuthController::class, 'store']) -> name('login.store');

Route::delete('logout', [AuthController::class, 'destroy']) -> name('logout');

Route::resource('user-account', UserAccountController::class)
->only('create', 'store');

Route::prefix('realtor')
->name('realtor.')
->middleware('auth')
->group(function () {

  Route::name('listing.restore')
      ->put(
        'listing/{listing}/restore',
        [RealtorListingController::class, 'restore']
      )->withTrashed();

  Route::resource('listing', RealTorListingController::class)
    ->only('index', 'destroy','edit', 'update', 'create', 'store')
    ->withTrashed();
});