<?php

namespace App\Http\Controllers;

use App\Http\Requests\Config\VacancyRequest;
use App\Models\Floor;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aVacancy = Vacancy::with('floor')->get();
        $aFloor   = Floor::get();

        return view('config.vacancy', ['aVacancy' => $aVacancy, 'aFloor' => $aFloor]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacancyRequest $request)
    {
        $aVacancy = $request->validated();

        try {
            Vacancy::create($aVacancy);
            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $floor_id = null)
    {
        $aVacancy = Vacancy::with('floor')
            ->when($floor_id, function ($query, $floor_id) {
                return $query->where('floor_id', $floor_id);
            })
            ->get();
    
        $aFloor = Floor::all();
    
        return view('config.vacancy', ['aVacancy' => $aVacancy, 'aFloor' => $aFloor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacancyRequest $request, string $id)
    {
        $aVacancy = $request->validated();

        try {
            Vacancy::whereId($id)->update($aVacancy);
            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vacancy = Vacancy::findOrFail($id);
            $vacancy->delete();
            
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
