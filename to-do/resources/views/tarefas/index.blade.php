@extends('layouts.app')

@section('title', 'Lista de Tarefas')

@section('content')
    <h1 class="mb-4"><a href="/" style="text-decoration: none; color: black;">To-do List</a></h1>

    <a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Nova Tarefa</a>

    <form method="GET" action="{{ route('tarefas.index') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-auto">
            <input type="text" name="busca" placeholder="Buscar pelo título" value="{{ request('busca') }}" class="form-control" />
        </div>

        <div class="col-auto">
            <select name="ordenar_por" class="form-select" onchange="this.form.submit()">
                <option value="data_vencimento" {{ $ordenarPor == 'data_vencimento' ? 'selected' : '' }}>Ordenar por Vencimento</option>
                <option value="pendente" {{ $ordenarPor == 'pendente' ? 'selected' : '' }}>Somente Pendentes</option>
                <option value="concluida" {{ $ordenarPor == 'concluida' ? 'selected' : '' }}>Somente Concluídas</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Buscar</button>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data de Vencimento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>
                        @if($tarefa->descricao)
                            <small class="text-muted">{{ $tarefa->descricao }}</small>
                        @else
                            <small class="text-muted">Sem descrição</small>
                        @endif
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($tarefa->data_vencimento)->format('d/m/Y') }}
                        @if($tarefa->status == 'pendente')
                            @php
                                $hoje = \Carbon\Carbon::today();
                                $vencimento = \Carbon\Carbon::parse($tarefa->data_vencimento);
                                $diffInDays = $hoje->diffInDays($vencimento, false);
                                $tooltipMessage = $diffInDays < 0 ? 'Tarefa vencida há ' . abs($diffInDays) . ' dia(s)' : 'Tarefa vence em ' . $diffInDays . ' dia(s)';
                            @endphp
                            @if($diffInDays < 0)
                                <i class="bi bi-exclamation-triangle text-danger" data-bs-toggle="tooltip" data-bs-title="{{ $tooltipMessage }}"></i>
                            @elseif($diffInDays <= 3)
                                <i class="bi bi-exclamation-triangle text-warning" data-bs-toggle="tooltip" data-bs-title="{{ $tooltipMessage }}"></i>
                            @endif
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('tarefas.toggleStatus', $tarefa->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <label class="custom-checkbox">
                                <input type="checkbox" name="status" onchange="this.form.submit()" {{ $tarefa->status == 'concluida' ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-sm btn-info text-white" aria-label="Editar tarefa">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" aria-label="Excluir tarefa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted fst-italic">Nenhuma tarefa encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $tarefas->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
    @endpush
@endsection
