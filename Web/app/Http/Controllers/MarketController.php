<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMarketBranchRequest;
use App\Http\Resources\MarketCollection;
use App\Http\Resources\MarketResource;
use App\Models\Address;
use App\Models\City;
use App\Models\Market;
use App\Http\Requests\StoreMarketRequest;
use App\Http\Requests\UpdateMarketRequest;
use App\Models\MarketBranch;
use App\Repositories\AddressRepository;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\MarketRepositoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class MarketController extends Controller
{

    protected MarketRepositoryContract $marketRepository;
    protected CityRepositoryContract $cityRepository;
    protected AddressRepositoryContract $addressRepository;

    /**
     * MarketController constructor
     *
     * @param MarketRepositoryContract $marketRepository
     * @param CityRepositoryContract $cityRepository
     * @param AddressRepositoryContract $addressRepository
     */
    public function __construct(MarketRepositoryContract $marketRepository, CityRepositoryContract $cityRepository, AddressRepositoryContract $addressRepository)
    {
        $this->marketRepository = $marketRepository;
        $this->cityRepository = $cityRepository;
        $this->addressRepository = $addressRepository;
    }


    /**
     * Retrieve All Markets Records with a given relationships array.
     *
     * @param Request $request
     * @return MarketCollection
     */
    public function getAllWithGivenRelations(Request $request)
    {
        $markets =  call_user_func_array(array($this->marketRepository,'getAllWithRelations'), $request->relations);

        return new MarketCollection($markets);
    }

    /**
     * Retrieve Market by id with a given relationships array.
     *
     * @param int $market
     * @param Request $request
     * @return MarketResource
     */
    public function getByIdWithGivenRelations(int $market, Request $request)
    {
        $market = $this->marketRepository->getByIdWithRelations($market, isset($request->relations)? $request->relations : []);

        return new MarketResource($market);
    }

    /**
     * Save new market resource
     *
     * @param StoreMarketRequest $request
     * @return JsonResponse
     */
    public function storeMarket(StoreMarketRequest $request): JsonResponse
    {
        $response = $this->marketRepository->createMarket($request);
        if($response instanceof QueryException){
            return new JsonResponse(['message' => $response->getMessage()], $response->getCode());
        } else {
            return new JsonResponse(['message' => __('response.success',['model' => 'Market'])], Response::HTTP_CREATED);
        }
    }

    /**
     * Save a new Market Branch resource
     *
     * @param Request $request
     * @param Market $market
     * @param City $city
     * @return JsonResponse
     */
    public function storeMarketBranch(Request $request, Market $market, City $city)
    {
        $response = $this->marketRepository->createMarketBranch($market, $city, $request, new AddressRepository());

        if($response instanceof QueryException){
            return new JsonResponse([ "message" => $response->getMessage() ], $response->getCode());
        } else {
            return new JsonResponse(["message" => __('response.success',['model' => MarketBranch::class])], Response::HTTP_CREATED);
        }
    }

    /**
     * @param UpdateMarketRequest $request
     * @param Market $market
     * @return mixed
     */
    public function updateMarket(UpdateMarketRequest $request, Market $market)
    {
        return $this->marketRepository->updateMarket($market, $request->all());
    }

    /**
     * @param UpdateMarketBranchRequest $request
     * @param MarketBranch $marketBranch
     * @return mixed
     */
    public function updateMarketBranch(UpdateMarketBranchRequest $request, MarketBranch $marketBranch)
    {
        if($request->has(Address::ADDRESS_ATTRIBUTE)) {
            $city = $this->cityRepository->getById($request->city);
            $address = $this->addressRepository->create($city, $request);
        } else {
            $address = null;
        }

        $this->marketRepository->updateMarketBranch($marketBranch, $request->all(), $address);

        return new JsonResponse(['message' => __('response.success', ['model' => 'Market Branch'])], Response::HTTP_OK);
    }

    /**
     * Remove the specified Market record.
     *
     * @param Market $market
     * @return JsonResponse
     */
    public function destroyMarket(Market $market)
    {
        $this->marketRepository->deleteMarket($market);

        return new JsonResponse(['message' => __('response.deleted', ['model' => Market::class])], Response::HTTP_OK);
    }

    /**
     * Remove the specified marketBranch record.
     *
     * @param MarketBranch $marketBranch
     * @return JsonResponse
     */
    public function destroyMarketBranch(MarketBranch $marketBranch)
    {
        $this->marketRepository->deleteMarketBranch($marketBranch);

        return new JsonResponse(['message' => __('response.deleted', ['model' => MarketBranch::class])], Response::HTTP_OK);
    }

    /**
     * Toggle user subscription to Market and return their status.
     *
     * @param MarketBranch $marketBranch
     * @return JsonResponse
     */
    public function toggleUserSubscriptionToMarketBranch(MarketBranch $marketBranch){
        $user = Auth::user();
        $this->marketRepository->toggleUserToMarketBranch($user, $marketBranch);
        $subscribed = $user->subscriptions->contains($marketBranch);

        return new JsonResponse(['message' => ($subscribed)? __('response.user.marketBranch.subscribed', ['marketBranch' => $marketBranch->name]) : __('response.user.marketBranch.unsubscribed', ['marketBranch' => $marketBranch->name])],Response::HTTP_OK);
    }
}
