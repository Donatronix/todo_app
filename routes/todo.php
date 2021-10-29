<?php

use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;


Route::prefix('todos')->group(function () {
    Route::get('/', [ToDoController::class, 'index'])->name('toDos.index');
    Route::get('/create', [ToDoController::class, 'create'])->name('toDos.create');
    Route::get('/{toDo:slug}/details', [ToDoController::class, 'show'])->name('toDos.show');
    Route::get('/{toDo:slug}/edit', [ToDoController::class, 'edit'])->name('toDos.edit');
    Route::get('/{toDo:slug}/completed', [ToDoController::class, 'completed'])->name('toDos.completed');
    Route::post('/store', [ToDoController::class, 'store'])->name('toDos.store');
    Route::put('/{toDo:slug}/update', [ToDoController::class, 'update'])->name('toDos.update');
    Route::delete('/{toDo:slug}/delete', [ToDoController::class, 'destroy'])->name('toDos.delete');
});
