<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TecnologyController;

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


// Rotte pubbliche
Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');


// rotte valide se loggato
Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group( function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('stats');
    Route::resource('projects', ProjectController::class);
    Route::resource('types', TypeController::class);
    Route::resource('tecnologies', TecnologyController::class);
    Route::get('orderby/{direction}', [ProjectController::class, 'orderby'])->name('orderby');
});

require __DIR__.'/auth.php';
