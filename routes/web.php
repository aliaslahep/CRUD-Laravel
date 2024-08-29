<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpreadsheetController;

use App\Http\Controllers\PDFController;


use App\Http\Middleware\UserLogging;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');

});

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified',UserLogging::class,'verified'])->name('dashboard');

Route::middleware(['auth',UserLogging::class])->group(function () {

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    include __DIR__.'/../app/Modules/Courses/routes.php';
    
});





require __DIR__.'/auth.php';
