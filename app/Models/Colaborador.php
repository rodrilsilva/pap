<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaborador';

    protected $fillable = ['nome', 'gen', 'id']; 

    public function marcacoes()
    {
        return $this->hasMany(Marcacao::class, 'colaborador_id');
    }
}
