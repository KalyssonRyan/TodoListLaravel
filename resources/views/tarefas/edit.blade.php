@extends('layouts.principal')
@section('content')
    <h1>Editar Nota</h1>

    <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo', $tarefa->titulo) }}" required>
        <br>

        <label for="descricao" class="form-label">Descrição</label>
        <textarea  class="form-control" name="descricao" id="descricao" required>{{ old('descricao', $tarefa->descricao) }}</textarea>
        <br>

        <button type="submit" class="btn btn-success">Atualizar Nota</button>
    </form>
@endsection

