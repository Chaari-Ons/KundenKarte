<?php

namespace App\Http\Resources;

use App\Models\Market;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Market */
class MarketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

//    public $collects = Market::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
