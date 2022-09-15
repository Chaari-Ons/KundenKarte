<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use App\Models\Profile;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\ProfileRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected ProfileRepositoryContract $profileRepository;
    protected AddressRepositoryContract $addressRepository;
    protected CityRepositoryContract $cityRepository;

    /**
     * ProfileController constructor
     *
     * @param ProfileRepositoryContract $profileRepository
     * @param AddressRepositoryContract $addressRepository
     * @param CityRepositoryContract $cityRepository
     */
    public function __construct(ProfileRepositoryContract $profileRepository, AddressRepositoryContract $addressRepository, CityRepositoryContract $cityRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->addressRepository = $addressRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @param Profile $profile
     * @return JsonResponse
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        if($request->has(Address::ADDRESS_ATTRIBUTE)){
            $city = $this->cityRepository->getById($request->city);
            $address = $this->addressRepository->create($city, $request);
        } else {
            $address = null;
        }

        $this->profileRepository->update($profile, $request, $address);

        return new JsonResponse(['message' => __('response.success', ['model' => 'Profile'])], Response::HTTP_OK);
    }
}
