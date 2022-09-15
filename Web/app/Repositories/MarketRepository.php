<?php


namespace App\Repositories;


use App\Models\Address;
use App\Models\City;
use App\Models\Market;
use App\Models\MarketBranch;
use App\Models\User;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\MarketRepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketRepository implements MarketRepositoryContract
{
    /**
     * Get all Market ressource with demanded relations.
     *
     * @param ...$relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithRelations(...$relations)
    {
        return Market::with($relations)->orderBy('name')->paginate(15);
    }

    /**
     * Get Market by id & [optional] array of relations name.
     *
     * @param $market
     * @param array $relations
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getByIdWithRelations($market, array $relations = []): Model|Collection|Builder|array|null
    {
        return Market::with($relations)->find($market);
    }


    /**
     * Store new Market record
     *
     * @param $request
     * @return bool|QueryException
     */
    public function createMarket($request): bool|QueryException
    {
        if($request->file('logo')){
            $file = $request->file('logo');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('public/Image/logos'), $fileName);
        }
        try {
            return Market::create([
                'name' => $request['name'],
                'logo' => isset($fileName) ? 'public/Image/logos/'.$fileName : '',
            ])->save();
        } catch(QueryException $exception) {
            return $exception->errorInfo;
        }
    }


    /**
     * Store new MarketBranch record
     *
     * @param Market $market
     * @param City $city
     * @param $data
     * @param AddressRepositoryContract $addressRepository
     * @return \Exception|false|Market|QueryException
     */
    public function createMarketBranch(Market $market, City $city, $data, AddressRepositoryContract $addressRepository): MarketBranch|bool|\Exception|QueryException
    {
        $addresse = $addressRepository->create($city, $data->only(['street', 'street_number', 'zip']));
        try {
            $marketBranch = new MarketBranch;

            $marketBranch->fill([
                'name' => $data->marketBranchName,
                'longitude' => $data->longitude,
                'latitude' => $data->latitude,
            ]);
            $marketBranch->address()->associate($addresse);
            return $market->marketBranches()->save($marketBranch);
        } catch (QueryException $exception){
            return $exception;
        }
    }

    /**
     * Update the given Market
     *
     * @param Market $market
     * @param $data
     * @return bool
     * @throws \Throwable
     */
    public function updateMarket(Market $market, $data): bool
    {
        return $market->updateOrFail($data);
    }

    /**
     * Update the given MarketBranch
     *
     * @param MarketBranch $marketBranch
     * @param $data
     * @param Address|null $address
     * @return bool
     * @throws \Throwable
     */
    public function updateMarketBranch(MarketBranch $marketBranch, $data, Address $address = null): bool
    {
        if($address){
            $marketBranch->address()->associate($address);
        }
        return $marketBranch->updateOrFail($data);
    }

    /**
     * Delete the given market
     *
     * @param Market $market
     * @return bool|null
     * @throws \Throwable
     */
    public function deleteMarket(Market $market): ?bool
    {
        return $market->deleteOrFail();
    }

    /**
     * Delete the given MarketBranch
     *
     * @param MarketBranch $marketBranch
     * @return bool|null
     * @throws \Throwable
     */
    public function deleteMarketBranch(MarketBranch $marketBranch): ?bool
    {
        return $marketBranch->deleteOrFail();
    }

    /**
     * Toggle user subscription to Market
     *
     * @param User $user
     * @param MarketBranch $marketBranch
     * @return void
     */
    public function toggleUserToMarketBranch(User $user, MarketBranch $marketBranch): void
    {
        $user->subscriptions()->toggle($marketBranch);
    }

}
