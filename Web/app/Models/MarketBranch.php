<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketBranch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'address_id',
        'market_id'
    ];

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
