<?php

namespace App\Repositories\Contracts;

use App\Models\City;

interface CityRepositoryContract
{
    public function getAll();
    public function getById($id);
    public function delete(City $city);
    public function create($data);
    public function update(City $city, $data);
}
