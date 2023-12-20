<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/data', [StudentController::class, 'getData'])->name('students.data');
Route::get('/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/store', [StudentController::class, 'store'])->name('students.store');
Route::put('/update-status/{id}', [StudentController::class, 'updateStatus'])->name('students.updateStatus');
Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('students.delete');
