<?php

namespace App\Models;

use App\Projections\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarEvent extends Model
{
    use HasFactory;

    protected $fillable = ['car_id', 'event_class', 'event_properties'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
