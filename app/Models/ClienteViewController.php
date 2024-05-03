<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteViewController extends Model
{
    public function create()
    {

        return view('pages.cliente.index');
    }}
