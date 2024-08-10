<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
          'code'
        , 'vacancy_id'
        , 'payment_id'
        , 'price'
        , 'time'
        , 'arrival_date'
        , 'departure_date'
    ];
}
