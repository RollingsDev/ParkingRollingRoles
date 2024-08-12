<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class FloorsController extends Controller
{
    public function indexFloorOne(string $floor)
    {
        $aVacancy = Vacancy::whereFloorId($floor)->get();

        $line = match($floor) {
              '1' => 10
            , '2' => 13
            , '3' => 15
        };

        $total = count($aVacancy);

        $aResponse = [
              'floor'   => $floor."º Andar"
            , 'total'   => $total
            , 'line'    => $line
            , 'diff'    => $line + $line - $total
            , 'vacancy' => $aVacancy 
        ];

        return view('vagas.floor', ['aResponse' => $aResponse]);
    }

    public function configFloor($level)
    {
        $aConfig = [
            1 => [
                  'row' => 2
                , 'int' => 20
            ]
            , 2 => [
                  'row' => 2
                , 'int' => 25
            ]
            , 3 => [
                  'row' => 2
                , 'int' => 30
            ]
        ];
    }
}
