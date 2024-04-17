<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'tipo_servico';

    protected $fillable = ['id', 'nome', 'duracao', 'preco', 'cor',];

    public function marcacoes()
    {
        return $this->hasMany(Marcacao::class, 'tipo_servico_id');
    }
}
