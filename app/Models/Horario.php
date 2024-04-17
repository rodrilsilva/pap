<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    //indicar nome da tabela
    protected $table = 'horarios';


    //indicar as colunas que podem ser registadas
    protected $fillable = ['id', 'hora_inicio_manha', 'hora_fim_manha', 'hora_inicio_tarde', 'hora_fim_tarde'];
}
