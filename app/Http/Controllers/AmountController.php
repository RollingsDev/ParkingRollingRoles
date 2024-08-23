<?php

namespace App\Http\Controllers;

use App\Http\Requests\Config\AmountRequest;
use App\Models\Amount;
use Illuminate\Http\Request;

class AmountController extends Controller
{
    public $payment;

    public function __construct() {
        $this->payment = new PaymentController;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->payment->index();
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
    public function store(AmountRequest $request)
    {
        $aAmount = $request->validated();

        try {
            Amount::create($aAmount);
            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Amount $amount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Amount $amount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AmountRequest $request, string $id)
    {
        // dd($id);
        $aAmount = $request->validate();

        try {
            Amount::whereId($id)->update($aAmount);
            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amount $amount)
    {
        try {
            $amount->delete();
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
