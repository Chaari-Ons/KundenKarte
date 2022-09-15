<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\User;
use App\Repositories\Contracts\AddressRepositoryContract;
use App\Repositories\Contracts\CityRepositoryContract;
use App\Repositories\Contracts\ProfileRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of the existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    protected Role $role;
    protected ProfileRepositoryContract $profileRepository;
    protected UserRepositoryContract $userRepository;
    protected CityRepositoryContract $cityRepository;
    protected AddressRepositoryContract $addressRepository;

    public function __construct(ProfileRepositoryContract $profileRepository, UserRepositoryContract $userRepository, CityRepositoryContract $cityRepository)
    {
        $this->middleware('guest')->except('logout', 'register');
        $this->role = Role::findByName(User::CUSTOMER_ROLE);
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param LoginRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(LoginRequest $request)
    {
        if ($this->attemptLogin($request)) {
            $user = auth()->user();
            if($request['loginType'] == User::MOBILE_LOGIN_TYPE && $user->getRoleNames()[0] != User::CUSTOMER_ROLE || $request['loginType'] == User::MANAGEMENT_LOGIN_TYPE && $user->getRoleNames()[0] == User::CUSTOMER_ROLE) {
                return $this->sendFailedLoginResponse($request);
            }

            $abilities = [];
            foreach ($user->roles->first()->getAllPermissions() as $permission) {
                array_push($abilities, $permission->name);
            }

            $accessToken = $user->createToken('authToken', $abilities)->plainTextToken;

            return response()->json(['token' => $accessToken, 'user' => new UserResource($user) ], 200);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return response()->json(['message' => 'success'], 200);
    }

    public function register(UserRequest $request)
    {
        $user = $this->userRepository->create($request);
        if($request->has(Address::ADDRESS_ATTRIBUTE)){
            $city = $this->cityRepository->getById($request->city);
            $address = $this->addressRepository->create($city, $request);
        } else {
            $address = null;
        }
        $this->profileRepository->create($user, $request, $address);
        $user->assignRole($this->role);

        return response()->json(['user' => new UserResource($user), 'message' => __('auth.register_success')], 200);
    }
}

