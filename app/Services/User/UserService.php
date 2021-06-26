<?php


namespace App\Services\User;


use App\JsonStructures\Base\JsonDictionary;
use App\JsonStructures\User\UserJson;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Config;

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

        $userJson = (new UserJson([
            JsonDictionary::USER => $user,
            JsonDictionary::CULTURE_DESCRIPTION => $this->cultureDescription
        ]))->toArray();

        return $userJson;
    }

}
