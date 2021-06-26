<?php

namespace App\JsonStructures\Base;

use Illuminate\Support\Facades\Lang;

class JsonResponse
{

    /**
     * @param array $data
     * @param null $message
     * @param int $code
     * @param int $httpStatus
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($data = [], $message = null, $code = 0, $httpStatus = 200)
    {
        if (!$message) {
            $message = Lang::get('response.general.success');
        }

        $response = [
            JsonDictionary::RETURN_CODE => $code,
            JsonDictionary::MESSAGE => $message,
            JsonDictionary::DATA => $data
        ];

        if (!empty($data)) {
            $response[JsonDictionary::DATA] = $data;
        }

        return response()->json($response, $httpStatus);
    }

    /**
     * @param null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function responseException($message = null, $code = 0)
    {
        if (!$message) {
            $message = Lang::get('response.general.success');
        }

        $response = [
            JsonDictionary::RETURN_CODE => $code,
            JsonDictionary::MESSAGE => $message,
        ];

        return response()->json($response);
    }
}
