<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = [
          'number'
        , 'name'
        , 'status'
    ];

    public function vacancy()
    {
        return $this->hasOne(Vacancy::class, 'floor_id', 'id');
    }
}
