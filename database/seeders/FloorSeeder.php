<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Floor::create([
              'number' => '1'
            , 'name'   => 'Primeiro Andar'
            , 'status' => 1
        ]);

        Floor::create([
              'number' => '2'
            , 'name'   => 'Segundo Andar'
            , 'status' => 1
        ]);

        Floor::create([
              'number' => '3'
            , 'name'   => 'Terceiro Andar'
            , 'status' => 1
        ]);
    }
}
