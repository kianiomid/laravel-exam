<?php

namespace App\Http\Controllers\Api\v1\Sms;

use App\Http\Controllers\Controller;
use App\JsonStructures\Base\JsonDictionary;
use App\JsonStructures\Base\JsonResponse;
use App\Services\SMS\SmsInterface;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class SmsController extends Controller
{
    protected $sms;
    protected $userService;

    /**
     * SmsController constructor.
     * @param SmsInterface $smsInterface
     */
    public function __construct(SmsInterface $smsInterface, UserService $userService)
    {
        $this->sms = $smsInterface;
        $this->userService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function send()
    {
        $userList = $this->userService->index();

        $userMobile = [];
        foreach ($userList[JsonDictionary::USERS] as $users) {
            foreach ($users as $user) {
                $userMobile[] = $user['mobile'];
            }
        }

//        $receptor = $userMobile;
         $receptor = ["09331116877"];

        $message = Lang::get('texts.kavenegar.sms_service');

        $smsInfo = $this->sms->sendSms($receptor, $message);

        return JsonResponse::response($smsInfo, Lang::get('response.general.success'), 200, 200);
    }
}
