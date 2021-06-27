<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\JsonDictionary;
use App\JsonStructures\Base\JsonResponse;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api');

        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->userService->index();

        return JsonResponse::response(array_merge(
            $users[JsonDictionary::USERS],
            $users[JsonDictionary::PAGINATION]
        ), Lang::get('response.general.success'), 200, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $user = $this->userService->userProfile();

        return JsonResponse::response($user, Lang::get('response.general.success'), 200, 200);
    }
}
