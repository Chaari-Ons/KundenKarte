<?php
namespace App\Repositories;

use App\Repositories\Contracts\AddressRepositoryContract;
use App\Models\City;

class AddressRepository implements AddressRepositoryContract
{
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function create(City $city, $data)
    {
        return $city->address()->create([
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'zip' => $data['zip']
        ]);
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }
}
