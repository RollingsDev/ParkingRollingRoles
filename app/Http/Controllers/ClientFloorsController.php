<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Nette\Utils\Arrays;

use function PHPUnit\Framework\isNull;

class ClientFloorsController extends Controller
{
    public function indexFloor(string $floor)
    {
        
        $aVacancy = Vacancy::with(['client' => function ($query) {  
            $query->whereDepartureDate(NULL)  
                  ->selectRaw("*, DATE_FORMAT(arrival_date, '%H:%i:%s') as formatted_arrival_date");  
        }])->whereFloorId($floor)->get(); 
        
        $line = match($floor) {
              '1' => 10
            , '2' => 13
            , '3' => 15
        };

        $total    = count($aVacancy);
        $occupied = $this->checkFloor($floor);

        $aResponse = [
              'floor'    => $floor."º Andar"
            , 'total'    => $total
            , 'line'     => $line
            , 'diff'     => $line + $line - $total
            , 'vacancy'  => $aVacancy 
            , 'occupied' => $occupied
        ];

        return view('vagas.floor', ['aResponse' => $aResponse]);
    }

    public function checkFloor($floor)
    {
        $response = Client::with(['vacancy' => function ($query) use ($floor) {  
            $query->whereFloorId($floor);  
        }])->whereDepartureDate(null)->get(['id', 'vacancy_id']);  

        $aResponse = [];

        if(count($response) > 0){
            foreach ($response as $key => $value) {
                $aResponse[$value->vacancy_id] = $value->id;
            }
        }

        return $aResponse;
    }

    public function takeThePosition(Request $request)
    {
        $idVacancy = $request['vacancy_id'];
        // Pegando Placas Aleatorias
        $plate = 'JPS7D46'; 
        // $plate = $this->generateFakePlate(); 
        $code = $this->generateUniqueCode($plate);
        
        $aData = [
              'code'         => $code
            , 'plate'        => $plate
            , 'vacancy_id'   => $idVacancy
            , 'arrival_date' => date('Y-m-d H:i:s')
        ];
        
        if($this->verifyClient($plate)){
            $this->createClient($aData);
        }

        $floor_id = $this->getFloor($idVacancy);

        return $this->indexFloor($floor_id);
    }

    public function generateFakePlate() {  
        $letter = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 3));  
         
        $int1 = rand(0, 9);  
        $int2 = rand(0, 9);  
        $int3 = rand(0, 9);  
        
        $letraFinal = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 1));  
        
        $plate = $letter . $int1 . $letraFinal . $int2 . $int3;  
    
        return $plate;  
    }  

    public function generateUniqueCode($plate) {  
        $dateLive   = date('Y-m-d H:i:s'); 
        $input      = $plate . $dateLive;  
        $hash       = md5($input);
        $uniqueCode = substr($hash, 0, 8);  
        
        return strtoupper($uniqueCode); 
    }  

    public function getFloor($id)
    {
        $floor = Vacancy::whereId($id)->get('floor_id');

        return $floor[0]->floor_id;
    }

    public function verifyClient($plate)
    {
        $response = Client::wherePlateAndDepartureDate($plate, null)->get();

        return empty($response[0]);
    }

    public function createClient(array $aData)
    {
        try {
            Client::create($aData);
            $response = true;
        } catch (\Throwable $th) {
            $response = false;
        }

        return $response;
    }
}
