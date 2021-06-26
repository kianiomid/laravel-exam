<?php


namespace App\JsonStructures\Base;


abstract class BaseJsonStructure
{

    protected $messages = [];
    protected $hasError = false;

    /**
     * @return mixed
     */
    protected abstract function toArray();

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
