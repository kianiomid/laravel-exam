<?php

namespace App\JsonStructures\Auth;


use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;
use App\JsonStructures\User\UserJson;

class NewTokenJson extends BaseJsonStructure
{

    const BEARER = 'bearer';

    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $token = isset($this->options[JsonDictionary::TOKEN]) ? $this->options[JsonDictionary::TOKEN] : null;
        $cultureDesc = isset($this->options[JsonDictionary::CULTURE_DESCRIPTION]) ? $this->options[JsonDictionary::CULTURE_DESCRIPTION] : null;

        //user object
        $userJson = (new UserJson([
            JsonDictionary::USER => auth()->user(),
            JsonDictionary::CULTURE_DESCRIPTION => $cultureDesc
        ]))->toArray();

        $res = null;
        $res = [
            JsonDictionary::NS_ACCESS_TOKEN => $token,
            JsonDictionary::NS_TOKEN_TYPE => self::BEARER,
            JsonDictionary::NS_EXPIRE_IN => auth()->factory()->getTTL() * 60,
            JsonDictionary::NS_USER => $userJson
        ];

        return $res;
    }
}
