<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Address */
class AddressResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'street' => $this->street,
            'street_number' => $this->street_number,
            'zip' => $this->zip,
            'city' => new CityResource($this->city),
            'full_address' => $this->street.' '.$this->street_number.', '.$this->zip.' '.$this->city->name
        ];
    }
}
