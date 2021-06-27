<?php


namespace App\JsonStructures\Base;


class PaginationJson extends BaseJsonStructure
{
    protected $options;

    /**
     * PaginationJson constructor.
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
        $res = null;
        $pagination = isset($this->options[JsonDictionary::PAGINATION]) ? $this->options[JsonDictionary::PAGINATION] : null;

        if (!empty($pagination)) {
            $res = [
                JsonDictionary::TOTAL => $pagination->total(),
                JsonDictionary::LAST_PAGE => $pagination->lastPage(),
                JsonDictionary::PER_PAGE => $pagination->perPage(),
                JsonDictionary::CURRENT_PAGE => $pagination->currentPage(),
                JsonDictionary::PATH => $pagination->path(),
            ];
        }

        return $res;
    }
}
