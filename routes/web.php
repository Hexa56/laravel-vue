<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenceController;
use App\Http\Controllers\authController;

// Auth Routes
Route::get('/signup', function () {
    return Inertia('Register');
});
Route::get('/login', function () {
    return Inertia('Index');
});
Route::post('signup', [authController::class, 'signup']);
Route::post('login', [authController::class, 'login']);


//Expense Routes
Route::get('/home',[ExpenceController::class, 'index'])->middleware('shield');
Route::get('/view',[ExpenceController::class, 'show'])->middleware('shield');
Route::post('/view',[ExpenceController::class, 'show'])->middleware('shield');
Route::get('/addexpense', [ExpenceController::class, 'create'])->middleware('shield');
Route::post('/addexpense', [ExpenceController::class, 'store'])->middleware('shield');
Route::get('/update/{id}', [ExpenceController::class, 'edit'])->middleware('shield');
Route::post('/update', [ExpenceController::class, 'update'])->middleware('shield');
Route::delete('/delete', [ExpenceController::class, 'destroy'])->middleware('shield');
Route::post('/filter', [ExpenceController::class, 'filter'])->middleware('shield');

Route::get('/logout', function () {
    request()->session()->flush();
    return redirect('/login');
})->middleware('shield');


