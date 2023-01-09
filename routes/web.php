<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CompoundController;
use App\Http\Controllers\CompoundImageController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EstatesController;
use App\Http\Controllers\Admin\OwnerController;
use App\Http\Controllers\Admin\TenantController as AdminTenantController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PropertyOwnerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantInfoController;
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

Route::fallback(function () {
    return 'Hm, why did you land here somehow?';
});
Route::view('/', 'landingpage');
Route::get('register', [AuthController::class, 'showRegister'])->name('register.create');
Route::post('register', [AuthController::class, 'register'])->name('register.store');
Route::get('verification/{id}', [AuthController::class, 'showVerificationCode'])->name('verify.account');
Route::post('verification/{id}', [AuthController::class, 'verificationCode']);

Route::middleware('guest:owner,admin')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('dashboard.login');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('guest:owner')->group(function () {
    Route::get('/forget-password', [AuthController::class, 'showForgetPassword'])->name('password.forget');
    Route::post('/forgot-password', [AuthController::class, 'emailForgetPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin,owner']
    ],

    function () {

        Route::get('/dashboard', [Controller::class, 'homeController'])->name('page.home')->middleware('auth:owner,admin');

        Route::middleware('auth:owner')->group(
            function () {


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
                Route::get('apartment/create', [ApartmentController::class, 'create'])->name('apartment.create.type');
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
                Route::get('advanced/search', [TenantController::class, 'advancedSearch'])->name('advanced.search');
                //
                Route::view('comm/tenant', 'dashboard.owner.apartment.commercial.create');
                /* ************************** end tenant ************************** */

                /* ************************** tenant_info ************************** */
                Route::resource('tenant-info', TenantInfoController::class);
                /* ************************** end tenant_info ************************** */

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

        Route::middleware('auth:admin')->group(
            function () {

                /* ************************** compound ************************** */
                Route::get('compounds/all', [EstatesController::class, 'compoundIndex'])->name('compound.all');
                Route::get('compounds/search', [EstatesController::class, 'compoundSearch'])->name('compound.search');
                /* ************************** end compound ************************** */

                /* ************************** building ************************** */
                Route::get('buildings/all', [EstatesController::class, 'buildingIndex'])->name('building.all');
                Route::get('buildings/search', [EstatesController::class, 'buildingSearch'])->name('building.search.admin');
                /* ************************** end building ************************** */

                /* ************************** apartment ************************** */
                Route::get('apartments/all', [EstatesController::class, 'apartmentIndex'])->name('apartment.all');
                Route::get('apartments/search', [EstatesController::class, 'apartmentSearch'])->name('apartment.search.admin');
                /* ************************** end apartment ************************** */

                /* ************************** tenant ************************** */
                Route::get('tenants/all', [AdminTenantController::class, 'tenantIndex'])->name('tenant.all');
                Route::get('tenants/search', [AdminTenantController::class, 'tenantSearch'])->name('tenant.search.admin');
                /* ************************** end tenant ************************** */

                /* ************************** owner ************************** */
                Route::get('owners/all', [OwnerController::class, 'ownerIndex'])->name('owner.all');
                Route::get('owners/search', [OwnerController::class, 'ownerSearch'])->name('owner.search.admin');
                /* ************************** end owner ************************** */
            }
        );
    }
);
