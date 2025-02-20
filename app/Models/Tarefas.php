<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tarefas extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descricao', 'user_id', 'completado', // Adiciona 'is_ativo' aqui
    ];
    public function user()
    {
        return $this->belongsTo(User::class);  // A tarefa pertence a um usuário
    }
}
