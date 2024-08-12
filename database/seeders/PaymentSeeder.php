<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
              'name'   => 'Pix'
            , 'status' => 1
        ]);
        
        Payment::create([
              'name'   => 'Cartão de Crédito'
            , 'status' => 1
        ]);
        
        Payment::create([
              'name'   => 'Cartão de Débito'
            , 'status' => 1
        ]);

        Payment::create([
              'name'   => 'Dinheiro'
            , 'status' => 1
        ]);

        Payment::create([
              'name'   => 'Cheque'
            , 'status' => 0
        ]);
    }
}
