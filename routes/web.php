<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CompoundController;
use App\Http\Controllers\CompoundImageController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PropertyOwnerController;
use App\Models\PropertyOwner;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::middleware('guest:owner,admin,employee')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin,employee,owner']
    ],
    function () {
        Route::view('', 'dashboard.home_page')->name('page.home');

        /* ************************** owner ************************** */
        Route::resource('owner', PropertyOwnerController::class);
        /* ************************** end owner ************************** */

        /* ************************** compound ************************** */
        Route::resource('compound', CompoundController::class);
        Route::get('search', [CompoundController::class, 'search'])->name('search');
        /* ************************** end compound ************************** */

        /* ************************** building ************************** */
        Route::resource('building', BuildingController::class);
        Route::delete('building/image/{id}', [BuildingController::class, 'deleteImage'])->name('building.image.delete');
        Route::get('search/building', [BuildingController::class, 'search'])->name('building.search');
        /* ************************** end building ************************** */

        /* ************************** apartment ************************** */
        Route::resource('apartment', ApartmentController::class);
        /* ************************** end apartment ************************** */

        //delete images ..
        Route::delete('compound/image/{id}', [CompoundImageController::class, 'deleteImage'])->name('compound.image.delete');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    }
);
