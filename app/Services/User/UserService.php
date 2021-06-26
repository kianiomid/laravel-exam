<?php


namespace App\Services\User;


use App\JsonStructures\Auth\NewTokenJson;
use App\JsonStructures\Base\JsonDictionary;
use App\JsonStructures\User\UserJson;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\UnauthorizedException;

class UserService
{
    private $userRepo;
    public $cultureDescription;
    public $token = true;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;

        $this->cultureDescription = Config::get('app.CULTURE_DESCRIPTION');
    }

    /**
     * @param $data
     * @return array
     */
    public function register($data)
    {
        $user = $this->userRepo->save($data);

        if ($this->token) {
            return $this->login($data);
        }

        $userJson = (new UserJson([
            JsonDictionary::USER => $user,
            JsonDictionary::CULTURE_DESCRIPTION => $this->cultureDescription
        ]))->toArray();

        return $userJson;
    }

    /**
     * @param $data
     * @return array
     */
    public function login($data)
    {
        if (!$token = auth()->attempt($data)) {
            throw new UnauthorizedException(Lang::get('response.errors.unauthorized'), 401);
        }

        $newTokenJson = null;
        $newTokenJson = (new NewTokenJson([
            JsonDictionary::TOKEN => $token,
            JsonDictionary::CULTURE_DESCRIPTION => $this->cultureDescription
        ]))->toArray();

        return $newTokenJson;
    }

    public function logout()
    {
        auth()->logout();

        /*$rules = [
            'token' => 'required',
        ];

        $this->validate(request(), $rules);

        try {
            JWTAuth::invalidate(request()->token);

            return JsonResponse::response([], Lang::get('response.general.logged_out_successfully'), 200, 200);

        } catch (JWTException $exception) {
            throw new InternalErrorException(Lang::get('response.errors.sorry_the_user_cannot_be_logged_out'), 500);
        }*/
    }

}
