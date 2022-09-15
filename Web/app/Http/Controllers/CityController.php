<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Repositories\Contracts\CityRepositoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CityController extends Controller
{

    protected CityRepositoryContract $cityRepository;

    /**
     * CityController constructor
     *
     * @param CityRepositoryContract $cityRepository
     */
    public function __construct(CityRepositoryContract $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Retrieve all City records
     *
     * @return CityCollection
     */
    public function index()
    {
        $city = $this->cityRepository->getAll();

        return new CityCollection($city);
    }

    /**
     * Store new city resource
     *
     * @param StoreCityRequest $request
     * @return JsonResponse
     */
    public function store(StoreCityRequest $request)
    {
        $response = $this->cityRepository->create($request->all());

        if($response instanceof QueryException){
            return new JsonResponse(['message' => $response->getMessage() ], $response->getCode());
        } else {
            return new JsonResponse(['message' => __('response.success',['model' => 'City'])], Response::HTTP_CREATED);
        }
    }

    /**
     * Retrieve City by id
     *
     * @param City $city
     * @return CityResource
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Update City resource
     *
     * @param StoreCityRequest $request
     * @param City $city
     * @return mixed
     */
    public function update(StoreCityRequest $request, City $city)
    {
        return $this->cityRepository->update($city, $request->all());
    }

    /**
     * Delete City resource
     *
     * @param City $city
     * @return JsonResponse
     */
    public function destroy(City $city)
    {
        $this->cityRepository->delete($city);

        return new JsonResponse(['message' => __('response.deleted', ['model' => 'City'])], Response::HTTP_OK);
    }
}
