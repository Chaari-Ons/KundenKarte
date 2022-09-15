<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{

    protected  $fillable = [
        'name'
    ];

    /**
     * Accessor & Mutator for name attribute
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::ucfirst($value),
            set: fn($value) => Str::lower($value)
        );
    }

    /**
     * Address relationship
     *
     * @return HasMany
     */
    public function address(): HasMany
    {
        return $this->hasMany(Address::class);
    }

}
