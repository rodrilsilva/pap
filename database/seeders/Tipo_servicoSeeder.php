<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipo_servicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_servico')->insert([
            "nome" => "Corte de Cabelo Homem",
            "duracao" => "35",
            "preco" => "10.00",
            "cor" => "#273cdd",
        ]);

        DB::table('tipo_servico')->insert([
            "nome" => "Coloração",
            "duracao" => "60",
            "preco" => "30.00",
            "cor" => "#d66666",
        ]);

        DB::table('tipo_servico')->insert([
            "nome" => "Alisamento",
            "duracao" => "400",
            "preco" => "100.00",
            "cor" => "#4e357e",
        ]);

        DB::table('tipo_servico')->insert([
            "nome" => "Corte de Cabelo Mulher",
            "duracao" => "45",
            "preco" => "20.00",
            "cor" => "#7b2019",
        ]);

        DB::table('tipo_servico')->insert([
            "nome" => "Madeixas",
            "duracao" => "70",
            "preco" => "40.00",
            "cor" => "#630198",
        ]);
    }
}
