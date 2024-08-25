<?php

namespace App\Http\Controllers;

use App\Http\Requests\Config\PaymentRequest;
use App\Models\Amount;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aPayment = Payment::get();

        $aAmount = Amount::get();

        foreach ($aAmount as $key => $value) {
            list($aAmount[$key]['hour'], $aAmount[$key]['minute']) = explode(':', $value['time']); 
        }

        $aResponse = [
              'aPayment' => $aPayment
            , 'aAmount'  => $aAmount
        ];

        return view('config.payment', $aResponse);
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
    public function store(PaymentRequest $request)
    {
        $aPayment = $request->validated();

        try {
            Payment::create($aPayment);
            return $this->index();
        } catch (\Throwable $th) {
            return $this->index();
        }
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
    public function update(PaymentRequest $request, string $id)
    {
        $aPayment = $request->validated();

        try {
            Payment::whereId($id)->update($aPayment);
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
            $payment = Payment::findOrFail($id);
            $payment->delete();
            
            return json_encode('success');
        } catch (\Throwable $th) {
            return json_encode('error');
        }
    }
}
