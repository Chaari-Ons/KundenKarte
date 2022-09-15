<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\City;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = City::firstOrCreate([
            'name' => 'city'
        ]);

        Address::firstOrCreate([
            'street' => 'street',
            'street_number' => '123',
            'zip' => '12345',
            'city_id' => $city->id
        ]);
    }
}
