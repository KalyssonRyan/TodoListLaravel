<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefas;
use Illuminate\Support\Facades\Auth;
class TarefaController extends Controller
{
    public function index(){
        $tarefas = Tarefas::where('user_id', Auth::id())->get();
        return view('tarefas.index',compact('tarefas'));
    }
    public function create(){
        return view('tarefas.create');
    }
    public function store(Request $request){
    
        $request->validate([
            'titulo'=> 'required|max:255',
            'descricao'=> 'required',
        ]);

        Tarefas::create([
            'titulo' =>$request->titulo,
            'descricao' => $request->descricao,
            'completado' => false,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('tarefas.index')->with('sucess','Tarefa criada com sucesso!');
    }
    

public function update(Request $request, $id)
{
    // Validação dos dados
    $request->validate([
        'titulo' => 'required|max:255',
        'descricao' => 'required',
    ]);

    // Encontre a tarefa pelo ID e atualize os dados
    $tarefa = Tarefas::findOrFail($id);
    $tarefa->update([
        'titulo' => $request->titulo,
        'descricao' => $request->descricao,
    ]);

    // Redireciona para a página de listagem das tarefas
    return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
}public function edit($id)
{
    // Encontre a tarefa pelo ID
    $tarefa = Tarefas::findOrFail($id);
    
    // Retorna a view de edição passando a tarefa
    return view('tarefas.edit', compact('tarefa'));
}
// Exclui uma tarefa
public function destroy($id)
{
    // Encontre a tarefa e exclua
    $tarefa = Tarefas::findOrFail($id);
    $tarefa->delete();

    // Redireciona de volta para a lista de tarefas
    return back()->with('success', 'Tarefa excluída com sucesso!');
}
public function completar(Tarefas $tarefa)
{
    // Verifica se a tarefa já está marcada como completada
    if ($tarefa->completado) {
        return redirect()->route('tarefas.index')->with('error', 'A tarefa já está completada.');
    }

    // Marca a tarefa como completada
    $tarefa->completado = true;
    $tarefa->save();

    return redirect()->route('tarefas.index')->with('success', 'Tarefa marcada como completada!');
}
public function descompletar(Tarefas $tarefa)
{
    // Verifica se a tarefa já está marcada como completada
    if ($tarefa->completado) {
        $tarefa->completado = false;
    $tarefa->save();
    return redirect()->route('tarefas.completadas')->with('success', 'Tarefa voltou para a lista');
        
    }

    // Marca a tarefa como completada
    return redirect()->route('tarefas.index')->with('error', 'A tarefa já está completada.');
    
}

public function pendentes()
{
    // Filtrando as tarefas pendentes
    $tarefas = Tarefas::where('user_id', auth()->id())->where('completado', false)->get();

    return view('tarefas.index', compact('tarefas'));
}

public function completadas()
{
    // Filtrando as tarefas completadas
    $tarefas = Tarefas::where('user_id', auth()->id())->where('completado', true)->get();

    return view('tarefas.index', compact('tarefas'));
}

}
