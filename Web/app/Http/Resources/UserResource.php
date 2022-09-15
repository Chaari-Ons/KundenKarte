<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'gender' => $this->profile->gender,
            'dateOfBirth' => $this->profile->date_of_birth,
            'avatar' => $this->profile->avatar,
            'street' => $this->profile->address ? $this->profile->address->street : '',
            'streetNumber' => $this->profile->address ? $this->profile->address->street_number : '',
            'zip' => $this->profile->address? $this->profile->address->zip : '',
            'role' => $this->roles->first()->name,
            'permissions' => $this->roles->first()->permissions()->pluck('name'),
            'status' => $this->approved_at ? __('response.approved') : __('response.not_approved')
        ];
    }
}
