<?php

namespace App\Http\Controllers;

use App\Http\Requests\Config\FloorRequest;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aResponse = Floor::get(); 

        return view('config.floor', ['aResponse' => $aResponse]);
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
    public function store(FloorRequest $request)
    {
        $aValidated = $request->validated();

        try {
            Floor::create($aValidated);
        } catch (\Throwable $th) {
            return $this->index();
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(FloorRequest $request, string $id)
    {
        // dd($id, $request->validated());
        $aFloor = $request->validated();

        try {
            Floor::whereid($id)->update($aFloor);
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
            $floor = Floor::findOrFail($id);
            $floor->delete();

            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
    }
}
