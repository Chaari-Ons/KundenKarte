<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends BaseModel
{
    use HasFactory;

    protected  $fillable = [
        'code',
        'discount',
        'title',
        'description',
        'marketBranch_id',
        'created_by',
        'updated_by'
    ];

    public function marketBranch()
    {
        return $this->belongsTo(MarketBranch::class);
    }
}
