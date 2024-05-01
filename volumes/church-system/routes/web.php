<?php

use Inertia\Inertia;
use App\Models\Church;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'igrejas', 'as' => 'igrejas.'], function () {
        Route::get('/', [ChurchController::class, 'index'])->name('index');
        Route::get('/criar', [ChurchController::class, 'create'])->name('create');
        Route::post('/', [ChurchController::class, 'store'])->name('store');
        Route::get('/{church}', [ChurchController::class, 'show'])->name('show');
        Route::get('/{church}/editar', [ChurchController::class, 'edit'])->name('edit');
        Route::patch('/{church}', [ChurchController::class, 'update'])->name('update');
        Route::delete('/{church}', [ChurchController::class, 'destroy'])->name('destroy');
        Route::get('/{church}/membros', [ChurchController::class, 'members'])->name('members');
    });
});

require __DIR__.'/auth.php';
