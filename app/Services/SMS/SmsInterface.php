<?php

namespace App\Services\SMS;


interface SmsInterface
{
    /**
     * @param $to
     * @param $text
     * @return mixed
     */
    public function sendSms($to, $text);
}