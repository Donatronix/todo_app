<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;


Route::prefix('todo')->group(function () {
    Route::get('/', [ToDoController::class, 'index'])->name('todo.index');
    Route::get('/create', [ToDoController::class, 'create'])->name('todo.create');
    Route::get('/{todo}/details', [ToDoController::class, 'show'])->name('todo.show');
    Route::get('/{todo}/edit', [ToDoController::class, 'edit'])->name('todo.edit');
    Route::post('/store', [ToDoController::class, 'store'])->name('todo.store');
    Route::put('/{todo}/update', [ToDoController::class, 'update'])->name('todo.update');
    Route::delete('delete', [ToDoController::class, 'destroy'])->name('todo.delete');
});
