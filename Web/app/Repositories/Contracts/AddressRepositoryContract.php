<?php

namespace App\Repositories\Contracts;

use App\Models\City;

interface AddressRepositoryContract
{
    public function getAll();
    public function getById($id);
    public function delete($id);
    public function create(City $city, $data);
    public function update($id, $data);
}
