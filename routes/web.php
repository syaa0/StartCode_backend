<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodeController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/codes', [CodeController::class, 'index'])->name('codes.index');
Route::get('/codes/{id}', [CodeController::class, 'show'])->name('codes.show');

Route::get('/codes/view/{id}', [CodeController::class, 'viewById'])->name('viewbyid');



Route::middleware(['auth'])->group(function () {
    // Hanya Super Admin yang bisa mengakses route ini
    Route::get('/createcode', [CodeController::class, 'create'])->name('createcode')->middleware('can:isSuperAdmin');
    Route::post('/storecode', [CodeController::class, 'store'])->name('storecode')->middleware('can:isSuperAdmin');
    Route::get('/editcode/{id}', [CodeController::class, 'edit'])->name('editcode')->middleware('can:isSuperAdmin');
    Route::patch('/updatecode/{id}', [CodeController::class, 'update'])->name('updatecode')->middleware('can:isSuperAdmin');
    Route::delete('/deletecode/{id}', [CodeController::class, 'destroy'])->name('deletecode')->middleware('can:isSuperAdmin');
});


require __DIR__.'/auth.php';
