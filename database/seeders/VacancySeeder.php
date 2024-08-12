<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aAndar = [
              1 => 20
            , 2 => 25
            , 3 => 30
        ];

        foreach($aAndar as $key => $value){
            
            for ($i=1; $i <= $value; $i++) { 
                Vacancy::create([
                      'number'   => $i
                    , 'status'   => 1
                    , 'floor_id' => $key
                ]);
            }

        }

    }
}
