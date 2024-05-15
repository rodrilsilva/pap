<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fatura')->insert([
            "marcacao_id" => "1",
            "servico_id" => "3",
            "colaborador_id" => "1",
            "preco_final" => "100",
        ]);

        DB::table('fatura')->insert([
            "marcacao_id" => "2",
            "servico_id" => "2",
            "colaborador_id" => "2",
            "preco_final" => "30",
        ]);
    }
}
