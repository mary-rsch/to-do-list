@extends('layouts.app')

@section('title', 'Lista de Tarefas')

@section('content')
    <h1>Lista de Tarefas</h1>
    
    <a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Nova Tarefa</a>

    <ul class="list-group">
        @foreach ($tarefas as $tarefa)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $tarefa->titulo }}
                <span class="badge bg-secondary">{{ $tarefa->status }}</span>
            </li>
        @endforeach
    </ul>

    <div class="mt-3">
        {{ $tarefas->links() }}
    </div>
@endsection
