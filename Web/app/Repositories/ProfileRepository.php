<?php
namespace App\Repositories;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\Models\Address;
use App\Repositories\Contracts\ProfileRepositoryContract;
use Illuminate\Support\Str;

class ProfileRepository implements ProfileRepositoryContract
{
    /**
     * Delete the given profile
     *
     * @param Profile $profile
     * @return bool|null
     * @throws \Throwable
     */
    public function delete(Profile $profile): ?bool
    {
        return $profile->deleteOrFail();
    }



    /**
     * Create a new Profile
     *
     * @param User $user
     * @param $data
     * @param Address|null $address
     * @throws \Throwable
     */
    public function create(User $user, $data, Address $address = null )
    {
        if($data->file('avatar')){
            $file = $data->file('avatar');
            $filename = Str::squish(Str::lower(date('YmdHi').$file->getClientOriginalName()));
            $file->move(public_path('Image/avatars'), $filename);
        }

        $user->profile()->create([
            'gender' => $data['gender'],
            'date_of_birth' => $data['dateOfBirth'],
            'avatar' => isset($filename) ? 'public/Image/avatars/'.$filename : '',
            'address_id' => $address? $address->id : null
        ])->saveOrFail();
    }

    /**
     * Update a given profile resource
     *
     * @param Profile $profile
     * @param ProfileRequest $dataCollection
     * @param Address|null $address
     * @return bool
     * @throws \Throwable
     */
    public function update(Profile $profile, ProfileRequest $dataCollection, Address $address = null)
    {
        /** except relationships fields from mass assign */
        $data = $dataCollection->except(['_method', ...array_merge(User::$validationFields, User::$customValidationFields ), ...Address::$validationFields]);

        if($dataCollection->file('avatar')){
            $file = $dataCollection->file('avatar');
            $filename = Str::squish(Str::lower(date('YmdHi').$file->getClientOriginalName()));
            $file->move(public_path('Image/avatars'), $filename);
            $data['avatar'] = 'public/Image/avatars/'.$filename;
        }

        if($address){
            $profile->address()->associate($address);
        }

        return $profile->updateOrFail($data);
    }
}
