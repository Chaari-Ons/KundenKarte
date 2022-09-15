<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::firstOrCreate([
            'gender' => 'male',
            'date_of_birth' => '1993-02-02',
            'address_id' => 1,
            'user_id' => 1
        ]);
    }
}
