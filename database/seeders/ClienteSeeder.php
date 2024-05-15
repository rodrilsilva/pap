<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cliente')->insert([
            "nome" => "Ava Sears",
            "email" => "sit.amet@aol.com",
            "tlm" => "968148757",
            "nif" => "295979011",
            "observacoes" => "risus. Duis a mi fringilla mi lacinia mattis. Integer eu lacus. Quisque imperdiet, erat nonummy"
        ]);

        DB::table('cliente')->insert([
            "nome" => "Dolan Wynn",
            "email" => "ipsum.ac@hotmail.ca",
            "tlm" => "436813741",
            "nif" => "212766690",
            "observacoes" => "et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan"
        ]);

        DB::table('cliente')->insert([
            "nome" => "Mariko Galloway",
            "email" => "dictum.eu.placerat@outlook.com",
            "tlm" => "144745533",
            "nif" => "288955085",
            "observacoes" => "erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies"
        ]);

        DB::table('cliente')->insert([
            "nome" => "Lester Michael",
            "email" => "pede@yahoo.net",
            "tlm" => "251320771",
            "nif" => "48443915",
            "observacoes" => "Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget,"
        ]);

        DB::table('cliente')->insert([
            "nome" => "Penelope White",
            "email" => "placerat.velit@icloud.com",
            "tlm" => "526447668",
            "nif" => "114974137",
            "observacoes" => "urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus"
        ]);
    }
}

