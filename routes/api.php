<?php

use App\Modules\Vehicle\Presentation\Controller\BrandsController;
use App\Modules\Vehicle\Presentation\Controller\ModelsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', [BrandsController::class, 'index']);
    Route::post('/', [BrandsController::class, 'store']);
    Route::put('/{id}', [BrandsController::class, 'update']);
});

Route::prefix('models')->group(function () {

    Route::get('/', [ModelsController::class, 'index']);
    Route::post('/', [ModelsController::class, 'store']);
    Route::put('/{id}', [ModelsController::class, 'update']);
});
/*
Route::prefix('brands', function () {
    Route::post('/', [BrandController::class, 'store']);
});*/
