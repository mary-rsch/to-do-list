<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
public function index(Request $request)
{
    $busca = $request->input('busca');
    $ordenarPor = $request->input('ordenar_por', 'data_vencimento'); // valor padrao

    $query = Tarefa::query();

    if ($busca) {
        $query->where('titulo', 'like', '%' . $busca . '%');
    }

    if (in_array($ordenarPor, ['pendente', 'concluida'])) {
        $query->where('status', $ordenarPor);
        $query->orderBy('data_vencimento');
    }
    elseif ($ordenarPor === 'status') {
        $query->orderBy('status');
    }
    else {
        $query->orderBy('data_vencimento');
    }

    $tarefas = $query->paginate(10);

    return view('tarefas.index', compact('tarefas', 'busca', 'ordenarPor'));
}


    public function create()
    {
        return view('tarefas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255', 
            'descricao' => 'nullable|max:1000',
            'data_vencimento' => 'nullable|date',
            'status' => 'required|in:pendente,concluida',
        ]);

        Tarefa::create($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    public function edit(Tarefa $tarefa)
    {
        return view('tarefas.edit', compact('tarefa'));
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'nullable|max:1000',
            'data_vencimento' => 'nullable|date',
            'status' => 'required|in:pendente,concluida',
        ]);

        $tarefa->update($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa excluída com sucesso!');
    }

    public function toggleStatus(Tarefa $tarefa)
    {
        $novoStatus = $tarefa->status === 'concluida' ? 'pendente' : 'concluida';
        $tarefa->update(['status' => $novoStatus]);

        return redirect()->route('tarefas.index')->with('success', 'Status atualizado com sucesso!');
    }


}

