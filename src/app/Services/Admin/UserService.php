<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Getting a list of all users.
     *
     * @return array
     */
    public function index(): array
    {
        $users = User::all();

        return [
            'users' => $users
        ];
    }

    /**
     * Create new user.
     *
     * @param StoreRequest $request
     * @return User
     */
    public function store(StoreRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        return User::firstOrCreate($data);
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user): User
    {
        return $user;
    }

    /**
     * Update the specified user in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return User
     */
    public function update(UpdateRequest $request, User $user): User
    {
        $user->update($request->validated());

        return $user;
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return bool|null
     */
    public function destroy(User $user): bool|null
    {
        return $user->delete();
    }
}
