@extends('layouts.principal')

@section('content')
    <h1>Criar Nova Nota</h1>

    <form action="{{ route('tarefas.store') }}" method="POST">
        @csrf
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" required>
        <br>

        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control" id="descricao" required></textarea>
        <br>

        <button type="submit" class="btn btn-success">Criar Nota</button>
    </form>

    <a href="{{ route('tarefas.index') }}">Voltar para a lista</a>
@endsection

