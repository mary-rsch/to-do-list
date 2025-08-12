<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index'])->name('home');

Route::resource('tarefas', TarefaController::class);
Route::patch('tarefas/{tarefa}/concluir', [TarefaController::class, 'concluir'])->name('tarefas.concluir');
