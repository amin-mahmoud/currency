<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use GeoSot\EnvEditor\Controllers\EnvController ;

use   App\Http\Controllers\EnvController as EnvEditorController;


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

    Route::get('/env-editor', [EnvController::class, 'index'])->name('env-editor.index');


    Route::get('/env-editor-index', [EnvEditorController::class, 'index'])->name('env-editor.index');

    Route::get('/env-editor-create', [EnvEditorController::class, 'create'])->name('env-editor.create');

    Route::post('/env-editor-store', [EnvEditorController::class, 'store'])->name('env-editor.store');



    Route::get('/env-editor-edit/{key}', [EnvEditorController::class, 'edit'])->name('env-editor.edit');

    Route::post('/env-editor-update', [EnvEditorController::class, 'update'])->name('env-editor.update');
    Route::post('/env-editor-update/{key}', [EnvEditorController::class, 'destroy'])->name('env-editor.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
