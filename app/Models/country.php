<?php

namespace App\Models;

use App\Http\Traits\CountryAndCityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory, CountryAndCityTrait;

    protected $table = 'country';

    protected $fillable = [
        'name',
        'population',
        'area',
        'phone_code'
    ];

    public function cities(){
        return $this->hasMany(city::class);
    }
}
