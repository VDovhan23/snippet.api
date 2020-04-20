<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transformers\Users\UserTransformer;

class AuthController extends Controller
{
//    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login() {

        $credentials = request(['email', 'password']);

        if ($token = auth()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        else {
            throw new \Exception('bad data ');
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return fractal()->item(auth()->user())->transformWith(new UserTransformer())->toArray();
//        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'data' => compact('token')
        ]);
    }


    /**
     * @param UserCreateRequest $request
     *
     * @return array
     */
    public function register(UserCreateRequest $request) {

        $user = User::create($request->only('email', 'name', 'username', 'password'));

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            ->toArray();
    }

}
