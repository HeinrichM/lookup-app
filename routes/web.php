<?php

use App\Http\Controllers\CellNumberController;
use App\Http\Controllers\IPController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/ip/{ipAddress?}',[IPController::class,'index'])->name('ip.index');
    Route::post('/ip',[IPController::class,'store'])->name('ip.store');
    Route::get('/ip/{ipAddress}/toggle',[IPController::class,'update'])->name('ip.update');

    Route::get('/cellnumber/{cellNumber?}',[CellNumberController::class,'index'])->name('cellnumber.index');
    Route::post('/cellnumber',[CellNumberController::class,'store'])->name('cellnumber.store');

});
