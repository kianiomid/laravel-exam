<?php


namespace App\JsonStructures\User;


use App\Helpers\Util;
use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class UserJson extends BaseJsonStructure
{

    protected $options;

    /**
     * UserJson constructor.
     * @param $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $res = [];
        $user = isset($this->options[JsonDictionary::USER]) ? $this->options[JsonDictionary::USER] : null;
        $cultureDesc = isset($this->options[JsonDictionary::CULTURE_DESCRIPTION]) ? $this->options[JsonDictionary::CULTURE_DESCRIPTION] : null;

        if (!empty($user)) {
            $res = [
                JsonDictionary::ID => $user->getAttribute('id'),
                JsonDictionary::NAME => $user->getAttribute('name'),
                JsonDictionary::EMAIL => $user->getAttribute('email'),
                JsonDictionary::CREATED_AT => Util::i18n_date2($user->getAttribute('created_at'), $cultureDesc, false, null, false, false, false, false),
                JsonDictionary::UPDATED_AT => Util::i18n_date2($user->getAttribute('updated_at'), $cultureDesc, false, null, false, false, false, false),
                JsonDictionary::CREATED_AT_RAW => Util::i18n_date2($user->getAttribute('created_at'), $cultureDesc, false, null, false, false, false, true),
                JsonDictionary::UPDATED_AT_RAW => Util::i18n_date2($user->getAttribute('updated_at'), $cultureDesc, false, null, false, false, false, true),
            ];
        }

        return $res;
    }
}
