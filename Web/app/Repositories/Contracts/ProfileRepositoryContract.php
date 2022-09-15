<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\ProfileRequest;
use App\Models\Address;
use App\Models\Profile;
use App\Models\User;

interface ProfileRepositoryContract
{
    public function delete(Profile $profile);
    public function create(User $user, $dataCollection, Address $address = null);
    public function update(Profile $profile, ProfileRequest $dataCollection, Address $address = null);
}
