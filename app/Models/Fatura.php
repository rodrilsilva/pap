<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fatura extends Model
{
    use HasFactory;

    protected $table = 'fatura';

    protected $fillable = ['preco_final'];
}
