<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
          'code'
        , 'plate'
        , 'vacancy_id'
        , 'payment_id'
        , 'price'
        , 'time'
        , 'arrival_date'
        , 'departure_date'
    ];

    public function vacancy()
    {
        return $this->hasMany(Vacancy::class, 'id', 'vacancy_id');
    }
}
