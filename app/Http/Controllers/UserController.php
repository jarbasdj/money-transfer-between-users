<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function index()
    {
        return response($this->userRepository->all());
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->all());

        return response($user, 201);
    }

    public function show(int $id)
    {
        $user = $this->userRepository->find($id);

        return response($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Not implemented because it's not necessary on scenery
    }

    public function destroy($id)
    {
        // Not implemented because it's not necessary on scenery
    }
}
