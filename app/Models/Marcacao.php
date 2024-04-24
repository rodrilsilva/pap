<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Servico;
use App\Models\Colaborador;
use App\Models\Cliente;

class Marcacao extends Model
{
    use HasFactory;

    protected $table = 'marcacao';

    protected $fillable = ['data_hora', 'cliente_id', 'colaborador_id', 'tipo_servico_id', 'obs'];

    public static function proximaMarcacao()
    {
        return self::where('data_hora', '>', Carbon::now())
                   ->orderBy('data_hora')
                   ->first();
    }

    public function tipoServico()
{
    return $this->belongsTo(Servico::class, 'tipo_servico_id');
}

public function colaborador()
{
    return $this->belongsTo(Colaborador::class, 'colaborador_id');
}

public function cliente()
{
    return $this->belongsTo(Cliente::class, 'cliente_id');
}
}