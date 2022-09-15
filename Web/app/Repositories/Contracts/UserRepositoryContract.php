<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserRepositoryContract
{
    /**
     * Get all users records
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Retrieve only market admin approved users
     *
     * @return mixed
     */
    public function getOnlyApproved();
    public function getByRole(int|string $role);

    /**
     * Delete given user resource
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user);

    /**
     * Store new user resource
     * @param $data
     * @return mixed
     */
    public function create($data);
    public function update(User $user, UserRequest $dataCollection);
}
