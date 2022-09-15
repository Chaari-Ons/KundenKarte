<?php
namespace App\Repositories;


use App\Models\City;
use App\Repositories\Contracts\CityRepositoryContract;


class CityRepository implements CityRepositoryContract
{

    public function getAll()
    {
        return City::orderBy('name')->paginate();
    }

    public function getById($id){
        return City::find($id);
    }

    public function delete(City $city)
    {
        return $city->deleteOrFail();
    }

    public function create($data)
    {
        return City::create($data);
    }

    public function update(City $city, $data)
    {
        return $city->updateOrFail($data);
    }
}
