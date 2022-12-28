<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CompoundController;
use App\Http\Controllers\CompoundImageController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PropertyOwnerController;
use App\Http\Controllers\TenantController;
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

Route::get('register', [AuthController::class, 'showRegister'])->name('register.create');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::middleware('guest:owner,admin,employee')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin,owner']
    ],
    function () {
        Route::middleware('auth:owner')->group(
            function () {
                Route::get('', [Controller::class, 'homeController'])->name('page.home');

                /* ************************** owner ************************** */
                Route::resource('owner', PropertyOwnerController::class);
                /* ************************** end owner ************************** */

                /* ************************** compound ************************** */
                Route::resource('compound', CompoundController::class);
                Route::get('search', [CompoundController::class, 'search'])->name('search');
                Route::get('import/compound', [CompoundController::class, 'viewImport'])->name('compound.import');
                Route::post('import/compound', [CompoundController::class, 'importShippment'])->name('compound.import.store');
                /* ************************** end compound ************************** */

                /* ************************** building ************************** */
                Route::resource('building', BuildingController::class);
                Route::delete('building/image/{id}', [BuildingController::class, 'deleteImage'])->name('building.image.delete');
                Route::get('search/building', [BuildingController::class, 'search'])->name('building.search');
                Route::get('import/building', [BuildingController::class, 'viewImport'])->name('building.import');
                Route::post('import/building', [BuildingController::class, 'importShippment'])->name('building.import.store');
                /* ************************** end building ************************** */

                /* ************************** apartment ************************** */
                Route::resource('apartment', ApartmentController::class);
                Route::delete('apartment/image/{id}', [ApartmentController::class, 'deleteImage'])->name('apartment.image.delete');
                Route::get('search/apartment', [ApartmentController::class, 'search'])->name('apartment.search');
                Route::get('import/apartment', [ApartmentController::class, 'viewImport'])->name('apartment.import');
                Route::post('import/apartment', [ApartmentController::class, 'importApartment'])->name('apartment.import.store');
                Route::post('update/apartment/details/{apartment_id}', [ApartmentController::class, 'updateApartment'])->name('apartment.update.details');

                /* ************************** end apartment ************************** */

                /* ************************** tenant ************************** */
                Route::resource('tenant', TenantController::class);
                Route::get('search/tenant', [TenantController::class, 'search'])->name('tenant.search');
                Route::get('import/tenant', [TenantController::class, 'viewImport'])->name('tenant.import');
                Route::post('import/tenant', [TenantController::class, 'importTenants'])->name('tenant.import.store');
                Route::view('advanced/search', 'dashboard.owner.tenant.advanced_search')->name('searcch');
                /* ************************** end tenant ************************** */

                /* ************************** rentals ************************** */
                Route::resource('rental', ContractController::class);
                Route::get('rental/create/{id}', [ContractController::class, 'create'])->name('rental.create.id');
                Route::post('rental/delete/{id}', [ContractController::class, 'destroy'])->name('rental.destroy.id');
                /* ************************** end rentals ************************** */

                /* ************************** finance ************************** */

                Route::get('finance/index', [FinanceController::class, 'index'])->name('finance.index');
                Route::post('finance/search', [FinanceController::class, 'search'])->name('finance.search');
                Route::get('finance/live-search', [FinanceController::class, 'liveSearch'])->name('finance.live.search');

                /* ************************** end finance ************************** */

                //delete images ..
                Route::delete('compound/image/{id}', [CompoundImageController::class, 'deleteImage'])->name('compound.image.delete');
                Route::get('logout', [AuthController::class, 'logout'])->name('logout');
            }
        );
    }
);
