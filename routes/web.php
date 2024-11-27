<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilesClusterController;
use App\Http\Controllers\GraphController; // Asegúrate de importar el controlador GraphController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
    * Files cluster routes
    */
    Route::get('/files-cluster', [FilesClusterController::class, 'list'])->name('filesCluster');
    Route::post('/files-cluster', [FilesClusterController::class, 'upload'])->name('filesCluster.upload');

    /*
    * Profile routes
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    * Graph routes
    */
    Route::get('/graficos', [GraphController::class, 'index']); // Ruta para los gráficos
});

require __DIR__.'/auth.php';


