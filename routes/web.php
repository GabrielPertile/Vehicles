<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Vehicle\Presentation\Controller\BrandsController;
use App\Modules\Vehicle\Presentation\Controller\ModelsController;
use App\Modules\Vehicle\Presentation\Controller\VehiclesController;

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
    return view('layouts.app');
});

// Route::get('/brands', [BrandsController::class, 'index']);

Route::prefix('brands')->group(function () {

    Route::get('/', [BrandsController::class, 'index'])->name('brands.index');
    Route::get('/{id}', [BrandsController::class, 'show'])->name('brands.show');
    Route::post('/', [BrandsController::class, 'store'])->name('brands.store');
    Route::put('/{id}', [BrandsController::class, 'update'])->name('brands.update');
    Route::delete('/{id}', [BrandsController::class, 'destroy'])->name('brands.destroy');
});

Route::prefix('models')->group(function () {

    Route::get('/', [ModelsController::class, 'index'])->name('models.index');
    Route::get('/{id}', [ModelsController::class, 'show'])->name('models.show');
    Route::post('/', [ModelsController::class, 'store'])->name('models.store');
    Route::put('/{id}', [ModelsController::class, 'update'])->name('models.update');
    Route::delete('/{id}', [ModelsController::class, 'destroy'])->name('models.destroy');
});

Route::prefix('vehicles')->group(function () {
    Route::get('/', [VehiclesController::class, 'index'])->name('vehicles.index');
    Route::get('/{id}', [VehiclesController::class, 'show'])->name('vehicles.show');
    Route::post('/', [VehiclesController::class, 'store'])->name('vehicles.store');
    Route::put('/{id}', [VehiclesController::class, 'update'])->name('vehicles.update');
    Route::delete('/{id}', [VehiclesController::class, 'destroy'])->name('vehicles.destroy');
});
