<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'tlm', 'nif', 'observacoes', 'dh', 'users_id'];

    public function marcacoes()
    {
        return $this->hasMany(Marcacao::class, 'cliente_id');
    }

    public function proximaMarcacao()
    {
        return $this->marcacoes()->where('data_hora', '>', Carbon::now())->orderBy('data_hora')->first();
    }
}


