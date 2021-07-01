<?php

namespace App\Http\Controllers\Api\v1\Sms;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\JsonResponse;
use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class SmsController extends Controller
{

    protected $sms;

    /**
     * SmsController constructor.
     * @param SmsInterface $smsInterface
     */
    public function __construct(SmsInterface $smsInterface)
    {
        $this->sms = $smsInterface;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function send()
    {
        //we should get data from database but this section we set data as static
        $receptor = ["09331116877"];
        $message = Lang::get('texts.kavenegar.sms_service');

        $smsInfo = $this->sms->sendSms($receptor, $message);

        return JsonResponse::response($smsInfo, Lang::get('response.general.success'), 200, 200);
    }
}
