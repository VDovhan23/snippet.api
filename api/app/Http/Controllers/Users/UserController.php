<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Transformers\Users\PublicUserTransformer;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user  ) {
        return fractal()
            ->item($user)
            ->transformWith(new PublicUserTransformer())
            ->toArray();
    }

    public function update(UserUpdateRequest $request, User $user) {

        $this->authorize('as', $user);

        $user->update($request->only('email', 'name', 'username', 'password'));

        return $user;
    }
}
