<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'street_number',
        'zip',
        'city_id'
    ];

    static array $validationFields = [
        'street',
        'street_number',
        'zip',
        'city'
    ];

    const ADDRESS_ATTRIBUTE = ['city', 'street_number', 'zip', 'street'];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }
}
