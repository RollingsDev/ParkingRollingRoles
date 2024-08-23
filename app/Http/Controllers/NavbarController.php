<?php

namespace App\Http\Controllers;

use App\Http\Requests\NavbarRequest;
use App\Http\Requests\SearchWelcomeRequest;
use App\Models\Client;
use App\Models\Floor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NavbarController extends Controller
{
    public function index($search = null)
    {
        $aFloor = DB::table('floors as F')
        ->select(
              'F.name'
            , DB::raw('SUM(
                    CASE 
                        WHEN V.floor_id = F.id 
                            THEN 1 
                            ELSE 0 
                    END
                ) AS vacancies_total')
            , DB::raw('SUM(
                CASE 
                    WHEN C.vacancy_id = V.id 
                    AND  V.floor_id   = F.id 
                        THEN 1 
                        ELSE 0 
                END
            ) AS vacancies_in')
            , DB::raw('CONCAT(
                ROUND(
                    (
                        SUM(
                            CASE 
                                WHEN C.vacancy_id = V.id 
                                AND  V.floor_id   = F.id 
                                    THEN 1 
                                    ELSE 0 
                            END
                        ) / 
                    SUM(
                            CASE 
                                WHEN V.floor_id = F.id 
                                    THEN 1 
                                    ELSE 0 
                            END
                        )
                    ) * 100, 2
                ), "%"
            ) AS vacancies_perc')
        )
        ->leftJoin('vacancies as V', 'V.floor_id', '=', 'F.id')
        ->leftJoin('clients   as C', function ($join) {
            $join->on('C.vacancy_id', '=', 'V.id')
                 ->whereNull('C.departure_date');
        })
        ->where('F.status', 1)
        ->groupBy('F.name', 'F.id')
        ->get();

        $comboFloor = Floor::whereStatus(1)->get(['id', 'name']);

        $aResponse = [
              'aFloor'     => $aFloor
            , 'comboFloor' => $comboFloor
            , 'search'     => $search
        ];
        
        // dd($aResponse);
        return view('welcome', $aResponse);
    }

    public function search(SearchWelcomeRequest $request)
    {
        $aRequest = $request->validated();
        $verify   = array_filter($aRequest);
        $response = ['error' => 'Utilize ao menos um filtro para a busca'];
        
        if(!empty($verify)){
            $response = Client::select([
                'clients.code',
                'clients.plate',
                'clients.arrival_date',
                'vacancies.number AS vacancy_number',
                'floors.name AS floor_name'
            ])
            ->join('vacancies', 'vacancies.id', '=', 'clients.vacancy_id')
            ->join('floors', 'floors.id', '=', 'vacancies.floor_id')
            ->when(isset($aRequest["code"]), function($query) use ($aRequest) {
                return $query->where('clients.code', $aRequest["code"]);
            })
            ->when(isset($aRequest["plate"]), function($query) use ($aRequest) {
                return $query->where('clients.plate', $aRequest["plate"]);
            })
            ->when(isset($aRequest["floor_id"]), function($query) use ($aRequest) {
                return $query->where('floors.id', $aRequest["floor_id"]);
            })
            ->whereNull('clients.departure_date')
            ->get()
            ->map(function ($item) {
                $item->arrival_date = Carbon::parse($item->arrival_date)->format('H:i:s - d/m/Y');
                return $item;
            });
        }
        
        return $this->index($response);
    }

    public function returnView(NavbarRequest $request)
    {
        $aRequest = $request->validated();
        
        $view = match ($aRequest['btn']) {
              'config' => 'config/index'  
        };

        return view($view);
    }
}
