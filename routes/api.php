<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Vehicle\Presentation\Controller\BrandsController;
use App\Modules\Vehicle\Presentation\Controller\ModelsController;
use App\Modules\Vehicle\Presentation\Controller\VehiclesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('brands')->group(function () {

    Route::get('/', [BrandsController::class, 'index'])->name('brands.index');
//     Route::get('/{id}', [BrandsController::class, 'show'])->name('brands.show');
//     Route::post('/', [BrandsController::class, 'store'])->name('brands.store');
//     Route::put('/{id}', [BrandsController::class, 'update'])->name('brands.update');
});

// Route::prefix('models')->group(function () {

//     Route::get('/', [ModelsController::class, 'index'])->name('models.index');
//     Route::get('/{id}', [ModelsController::class, 'show'])->name('models.show');
//     Route::post('/', [ModelsController::class, 'store'])->name('models.store');
//     Route::put('/{id}', [ModelsController::class, 'update'])->name('models.update');
// });

// Route::prefix('vehicles')->group(function () {

//     Route::get('/', [VehiclesController::class, 'index'])->name('vehicles.index');
//     Route::get('/{id}', [VehiclesController::class, 'show'])->name('vehicles.show');
//     Route::post('/', [VehiclesController::class, 'store'])->name('vehicles.store');
//     Route::put('/{id}', [VehiclesController::class, 'update'])->name('vehicles.update');
// });
/*
Route::prefix('brands', function () {
    Route::post('/', [BrandController::class, 'store']);
});*/
