<?php

use App\Http\Controllers\BarcodeController;
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
    return view('welcome');
});

Route::resource('barcode', BarcodeController::class);
// Route::get('barcode_img', BarcodeController::class);
Route::get('/barcode_img/{id}', [BarcodeController::class, 'generate_img'])->name('barcode.download');


