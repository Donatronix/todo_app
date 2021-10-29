<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/{project:slug}/details', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/{project:slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/{project:slug}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/{project:slug}/delete', [ProjectController::class, 'destroy'])->name('projects.delete');
});
