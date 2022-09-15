<?php

namespace App\Providers;

use App\Repositories\AddressRepository;
use App\Repositories\CityRepository;
use App\Repositories\Contracts\MarketRepositoryContract;
use App\Repositories\MarketRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\ProfileRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $binds = collect([
                ['contract' => AddressRepositoryContract::class, 'implementation' => AddressRepository::class],
                ['contract' => CityRepositoryContract::class, 'implementation' => CityRepository::class],
                ['contract' => ProfileRepositoryContract::class, 'implementation' => ProfileRepository::class],
                ['contract' => MarketRepositoryContract::class, 'implementation' => MarketRepository::class],
                ['contract' => UserRepositoryContract::class, 'implementation' => UserRepository::class]
            ]
        );

        $binds->each(function($bind)  {
            $this->app->bind($bind['contract'], $bind['implementation']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
