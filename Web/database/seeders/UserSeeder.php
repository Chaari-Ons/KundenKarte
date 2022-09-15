<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'test',
            'lastname' => 'testlast',
            'email' => 'test@email.com',
            'password' => 'Test123456',
            'approved_at' => Carbon::now()
        ]);
    }
}
