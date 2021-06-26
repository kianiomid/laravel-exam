<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\JsonResponse;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Lang;

class JWTAuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register()
    {
        $rules = [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];

        $this->validate(request(), $rules);
        $data = request()->all();

        $userJson = $this->userService->register($data);

        return JsonResponse::response($userJson, Lang::get('response.general.success'), 200, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];

        $data = request()->only('email', 'password');

        $this->validate(request(), $rules);

        $newTokenJson = $this->userService->login($data);

        return JsonResponse::response($newTokenJson, Lang::get('response.general.success'), 200, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->userService->logout();
        return JsonResponse::response([], Lang::get('response.general.success'), 200, 200);
    }
}
