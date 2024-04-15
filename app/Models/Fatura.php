<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fatura extends Model
{
    use HasFactory;

    //indicar nome da tabela
    protected $table = 'fatura';


    //indicar as colunas que podem ser registadas
    protected $fillable = ['preco_final'];
}
