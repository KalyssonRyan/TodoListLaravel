@extends('layouts.principal')
@section('content')
    <h1>Notas</h1>
    <blockquote class="blockquote">
  <p>Um lugar perfeito onde voce pode fazer as suas anotações sem se preocupar com em perder o seu progresso!</p>

  <p>Clique a baixo e cria a sua nota</p>
</blockquote>
    <a href="{{ route('tarefas.create') }}" class="btn btn-success">Adicionar Nova Nota</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Link para pendentes -->
    @if(Route::currentRouteName() == 'tarefas.pendentes' || Request::is('tarefas'))
    <h3>Tarefas Pendentes</h3>
    <ul class="list-group">
        @foreach($tarefas->where('completado', false) as $tarefa)
            <li class="list-group-item">
                <strong>{{ $tarefa->titulo }}</strong>: {{ $tarefa->descricao }}
                <p><small>Criado por: {{ $tarefa->user->name }}</small></p>
                
                
                @if($tarefa->user_id == auth()->id())
                <a type="text" class="btn btn-info btn-sm" href="{{ route('tarefas.edit', $tarefa->id) }}">Editar</a>
                    <!-- Botão para marcar como completada -->
                    <form action="{{ route('tarefas.completar', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">Marcar como Completada</button>
                    </form>
                    
                    <!-- Botão de Excluir -->
                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
    @endif
    @if(Route::currentRouteName() == 'tarefas.completadas')
    <h3>Tarefas Completadas</h3>
    <ul class="list-group">
        @foreach($tarefas->where('completado', true) as $tarefa)
            <li class="list-group-item">
                <!-- Estilo para mostrar que a tarefa está completada (riscar o texto) -->
                <strong class="text-decoration-line-through">{{ $tarefa->titulo }}</strong>: 
                <span class="text-decoration-line-through">{{ $tarefa->descricao }}</span>
                
                <p><small>Criado por: {{ $tarefa->user->name }}</small></p>
                
                @if($tarefa->user_id == auth()->id())
                    <!-- Botão para desmarcar completada -->
                    <form action="{{ route('tarefas.descompletar', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning btn-sm">Desmarcar como Completada</button>
                    </form>

                    <!-- Botão de Editar -->
                    

                    <!-- Botão de Excluir -->
                    <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
    @endif
@endsection
