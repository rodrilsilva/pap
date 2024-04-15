<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    // Indicar nome da tabela
    protected $table = 'colaborador';

    // Indicar as colunas que podem ser registadas
    protected $fillable = ['nome']; // Adicione outras colunas conforme necessário

    // Relação um-para-muitos com as marcações
    public function marcacoes()
    {
        return $this->hasMany(Marcacao::class, 'colaborador_id');
    }
}
