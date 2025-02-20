<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tarefas', function () {
    return view('tarefas.index');
})->middleware(['auth', 'verified'])->name('tarefas');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tarefas', TarefaController::class)->except(['show']);
    Route::patch('/tarefas/{tarefa}/completar', [TarefaController::class, 'completar'])->name('tarefas.completar');
    Route::patch('/tarefas/{tarefa}/descompletar', [TarefaController::class, 'descompletar'])->name('tarefas.descompletar');
    Route::get('/tarefas/pendentes', [TarefaController::class, 'pendentes'])->name('tarefas.pendentes');
    Route::get('/tarefas/completadas', [TarefaController::class, 'completadas'])->name('tarefas.completadas');
    Route::resource('tarefas', TarefaController::class);

});



require __DIR__.'/auth.php';
