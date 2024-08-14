<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
          'number'
        , 'status'
        , 'floor_id'
    ];

    public function floor()
    {
        return $this->hasMany(Floor::class, 'id', 'floor_id');
    }

    public function client()
    {
        return $this->hasMany(Client::class, 'vacancy_id', 'id');
    }
}
