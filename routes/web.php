<?php

use App\Modules\Vehicle\Presentation\Controller\BrandsController;
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
    return view('layouts.app');
});

Route::get('/brands', [BrandsController::class, 'index']);

// Route::prefix('brands')->group(function () {

//     Route::get('/', [BrandsController::class, 'index'])->name('brands.index');
//     Route::get('/{id}', [BrandsController::class, 'show'])->name('brands.show');
//     Route::post('/', [BrandsController::class, 'store'])->name('brands.store');
//     Route::put('/{id}', [BrandsController::class, 'update'])->name('brands.update');
// });

