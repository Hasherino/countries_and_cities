<?php

namespace App\Models;

use App\Http\Traits\CountryAndCityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory, CountryAndCityTrait;

    protected $table = 'city';

    protected $fillable = [
        'name',
        'population',
        'area',
        'postal_code',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo(country::class);
    }
}
