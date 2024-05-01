<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = ['id', 'hora_inicio_manha', 'hora_fim_manha', 'hora_inicio_tarde', 'hora_fim_tarde'];
}
