@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Criar Nova Tarefa</h1>

        <form action="{{ route('tarefas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pendente">Pendente</option>
                    <option value="concluida">Concluída</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                <input type="date" class="form-control" id="data_vencimento" name="data_vencimento">
            </div>


            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

@endsection