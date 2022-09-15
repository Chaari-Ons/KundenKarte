<?php
namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\Address;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
    public function getAll()
    {
        return User::with('profile')->paginate();
    }

    public function getOnlyApproved()
    {
        return User::approved()->paginate();
    }

    public function getByRole(int|string $role)
    {
        return User::role($role)->paginate();
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    /**
     * create a new User
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'password' => $data['password'],
            'approved_at' => ($data->registrationFrom == User::MANAGEMENT_REGISTRATION) ? Carbon::now() : null
        ]);
    }

    /**
     * Update user resource
     *
     * @param User $user
     * @param UserRequest $dataCollection
     * @return bool
     * @throws \Throwable
     */
    public function update(User $user, UserRequest $dataCollection): bool
    {

        /** except relationships fields from mass assign */
        $data = $dataCollection->except(['_method', ...User::$customValidationFields, ...Profile::$validationFields, ...Address::$validationFields]);

        return $user->updateOrFail($data);
    }

}
