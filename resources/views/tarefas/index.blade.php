@extends('layouts.principal')
@section('content')
    <h1>Notas</h1>

    <a href="{{ route('tarefas.create') }}">Adicionar Nova Nota</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <h3>Pendentes</h3>
    <ul class="list-group">
        @foreach($tarefas->where('completado', false) as $tarefa)
            <li class="list-group-item">
                <strong>{{ $tarefa->titulo }}</strong>: {{ $tarefa->descricao }}
                <p><small>Criado por: {{ $tarefa->user->name }}</small></p>

                @if($tarefa->user_id == auth()->id())
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
    @endsection
    
    @section('pendente')
    <h3>Completadas</h3>
    <ul class="list-group">
        @foreach($tarefas->where('completado', true) as $tarefa)
            <li class="list-group-item">
                <!-- Estilo para mostrar que a tarefa está completada (riscar o texto) -->
                <strong class="text-decoration-line-through">{{ $tarefa->titulo }}</strong>: 
                <span class="text-decoration-line-through">{{ $tarefa->descricao }}</span>
                
                <p><small>Criado por: {{ $tarefa->user->name }}</small></p>

                @if($tarefa->user_id == auth()->id())
                    <!-- Botão para desmarcar completada -->
                    <form action="{{ route('tarefas.completar', $tarefa->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning btn-sm">Desmarcar como Completada</button>
                    </form>

                    <!-- Botão de Editar -->
                    <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-info btn-sm">Editar</a>

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
@endsection
