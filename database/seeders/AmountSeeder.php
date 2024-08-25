<?php

namespace Database\Seeders;

use App\Models\Amount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Amount::create([
              'time'   => '00:30'
            , 'price'  => '15,00'
            , 'status' => 1
        ]);
        
        Amount::create([
              'time'   => '01:00'
            , 'price'  => '22,50'
            , 'status' => 1
        ]);

        Amount::create([
              'time'   => '02:00'
            , 'price'  => '50,00'
            , 'status' => 1
        ]);

        Amount::create([
              'time'   => '03:00'
            , 'price'  => '80,00'
            , 'status' => 1
        ]);

    }
}
