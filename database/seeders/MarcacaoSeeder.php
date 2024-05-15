<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marcacao')->insert([
            "data_hora" => "2024-05-15 10:00:00",
            "cliente_id" => "1",
            "colaborador_id" => "1",
            "tipo_servico_id" => "3",
            "obs" => "risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy",
        ]);

        DB::table('marcacao')->insert([
            "data_hora" => "2024-05-16 10:00:00",
            "cliente_id" => "2",
            "colaborador_id" => "2",
            "tipo_servico_id" => "2",
            "obs" => "erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies",
        ]);
    }
}
