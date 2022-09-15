<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\Profile;
use App\Models\User;
use App\Notifications\RegistationNotification;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\ProfileRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $role;
    protected $profileRepository;
    protected $addressRepository;
    protected $cityRepository;
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param ProfileRepositoryContract $profileRepository
     * @param AddressRepositoryContract $addressRepository
     * @param CityRepositoryContract $cityRepository
     * @param UserRepositoryContract $userRepository
     */
    public function __construct(ProfileRepositoryContract $profileRepository, AddressRepositoryContract $addressRepository, CityRepositoryContract $cityRepository, UserRepositoryContract $userRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->addressRepository = $addressRepository;
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->role = Role::findByName(User::MARKET_ADMIN_ROLE);
    }

    public function index()
    {
        return new UserCollection($this->userRepository->getAll());
    }

    public function getAllApproved(Request $request){
        return new UserCollection($this->userRepository->getOnlyApproved());
    }
    public function getByRole(int|string $role){
        return $this->userRepository->getByRole($role);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create($request);
        $city = $this->cityRepository->getById($request['city']);
        $address = $this->addressRepository->create($city, $request);
        $this->profileRepository->create($user, $request, $address);
        $user->assignRole($request['role']);

        return new UserResource($user);
    }

    public function register(UserRequest $request)
    {
        $user = $this->userRepository->create($request);
        if($request->has(Address::ADDRESS_ATTRIBUTE)){
            $city = $this->cityRepository->getById($request['city']);
            $address = $this->addressRepository->create($city, $request);
        } else {
            $address = null;
        }

        $this->profileRepository->create($user, $request, $address);
        $user->assignRole($this->role);

        if($request->registrationFrom == User::PUBLIC_REGISTRATION) {
            $superAdmins = User::whereHas('roles', function ($query){
                $query->where('name', User::SUPER_ADMIN_ROLE);
            })->get();
            foreach($superAdmins as $superAdmin){
                $superAdmin->notify(new RegistationNotification($user));
            }
        }

        // send verification Email
        // todo change email template after having the correct one.
        event(new Registered($user));

        return response()->json(['user' => new UserResource($user), 'message' => __('auth.register_success_email')], 200);
    }

    public function update(UserRequest $request, User $user)
    {

        $this->userRepository->update($user, $request);

        if($request->has(Address::ADDRESS_ATTRIBUTE)){
            $city = $this->cityRepository->getById($request->city);
            $address = $this->addressRepository->create($city, $request);
        } else {
            $address = null;
        }

        $this->profileRepository->update($user->profile, $request, $address);

        return new JsonResponse(['message' => __('response.success', ['model' => 'User'])], Response::HTTP_OK);

    }
}
