<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index'])->name('home');
Route::patch('/tarefas/{tarefa}/toggle-status', [TarefaController::class, 'toggleStatus'])
    ->name('tarefas.toggleStatus');
Route::resource('tarefas', TarefaController::class);
Route::patch('tarefas/{tarefa}/concluir', [TarefaController::class, 'concluir'])->name('tarefas.concluir');
