<?php

namespace App\JsonStructures\Sms;

use App\JsonStructures\Base\BaseJsonStructure;
use App\JsonStructures\Base\JsonDictionary;

class KavenegarJson extends BaseJsonStructure
{

    protected $options;

    /**
     * Objective Store constructor.
     * @param $options
     */
    public function __construct( array $options)
    {
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $res = [
            JsonDictionary::MESSAGEID => $this->options['messageid'],
            JsonDictionary::MESSAGE => $this->options['message'],
            JsonDictionary::STATUS => $this->options['status'],
            JsonDictionary::STATUSTEXT => $this->options['statustext'],
            JsonDictionary::SENDER => $this->options['sender'],
            JsonDictionary::RECEPTOR => $this->options['receptor'],
            JsonDictionary::DATE => $this->options['date'],
            JsonDictionary::COST => $this->options['cost'],
        ];

        return $res;
    }
}
