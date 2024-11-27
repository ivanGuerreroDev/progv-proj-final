<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilesClusterController;
use App\Http\Controllers\MapReduceController;
use Illuminate\Support\Facades\Route;
use Opcodes\LogViewer\LogViewerController;

Route::middleware(['auth'])->group(function () {
    Route::get('/logs', [LogViewerController::class, 'index'])->name('log-viewer.index');
});


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
    Route::post('/files-cluster/download', [FilesClusterController::class, 'download'])->name('filesCluster.download');
    Route::get('/files-cluster/delete', [FilesClusterController::class, 'delete'])->name('filesCluster.delete');

    /*
    * Data Debugger routes
    */
    Route::get('/data-debugger', [MapReduceController::class, 'index'])->name('mapReduce');
    Route::post('/data-debugger', [MapReduceController::class, 'executeMapReduceApp'])->name('mapReduce.execute');
    Route::post('/data-debugger/save-output', [MapReduceController::class, 'saveMapReduceOutput'])->name('mapReduce.saveToDb');

    /*
    * Profile routes
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
