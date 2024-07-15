<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use GeoSot\EnvEditor\Controllers\EnvController ;

use   App\Http\Controllers\EnvController as EnvEditorController;
use   App\Http\Controllers\HistoryController;
use GeoSot\EnvEditor\EnvEditor;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function ( EnvEditor $editor) {

    $envValues = $editor->getEnvFileContent($fileName='../../.env');

       $exchangeRates  = $envValues->filter(function ($item) {
            return stripos(data_get($item,'key'), 'rate') !== false;
        }) ;

        $histories = auth()->user()?->histories;

    return Inertia::render('Dashboard', ['exchange_rates'=> $exchangeRates, 'histories'=> $histories]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {


    Route::post('/store-amount', [HistoryController::class, 'store'])->name('stor-amount');


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
