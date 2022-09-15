<?php

namespace App\Repositories\Contracts;



use App\Models\Address;
use App\Models\City;
use App\Models\Market;
use App\Models\MarketBranch;
use App\Models\User;

interface MarketRepositoryContract
{
    public function getAllWithRelations(...$relations);
    public function getByIdWithRelations($market, array $relations = []);
    public function createMarket($data);
    public function createMarketBranch(Market $market, City $city, $data, AddressRepositoryContract $addressRepository);
    public function updateMarket(Market $market, $data);
    public function updateMarketBranch(MarketBranch $marketBranch, $data, Address $address = null);
    public function deleteMarket(Market $market);
    public function deleteMarketBranch(MarketBranch $marketBranch);
    public function toggleUserToMarketBranch(User $user, MarketBranch $marketBranch);
}
