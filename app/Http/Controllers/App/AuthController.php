<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\LoginApiRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\RegisterApiRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @param RegisterApiRequest $request
     * @param UserService $service
     * @return JsonResponse
     */
    public function register(RegisterApiRequest $request, UserService $service)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $service->create($request->all());

        return $this->authResponse();
    }

    /**
     * @param LoginApiRequest $request
     * @return JsonResponse
     */
    public function login(LoginApiRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        return $this->authResponse();
    }

    /**
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(new UserResource(auth()->user()));
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @return JsonResponse
     */
    public function refresh()
    {
        return response()->json(
            $this->accessTokenData(auth()->refresh())
        );
    }

    /**
     * @param $token
     * @return array
     */
    protected function accessTokenData($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

    /**
     * @return JsonResponse
     */
    protected function authResponse()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $result = array_merge($this->accessTokenData($token), [
            'user' => new UserResource(auth()->user())
        ]);

        return response()->json($result);
    }

}
