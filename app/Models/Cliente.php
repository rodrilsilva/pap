<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = ['nome', 'email', 'tlm', 'nif', 'observacoes', 'dh', 'id'];

    // Relação um-para-muitos com as marcações
    public function marcacoes()
    {
        return $this->hasMany(Marcacao::class, 'cliente_id'); 
        //return $this->hasMany(Marcacao::class); original
    }

    public function proximaMarcacao()
    {
        return $this->marcacoes()->where('data_hora', '>', Carbon::now())->orderBy('data_hora')->first();
    }

    
}

