<?php

namespace App\Providers;

use App\Http\Controllers\Api\v1\Sms\SmsController;
use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SmsServiceProvider extends ServiceProvider
{
    const KAVENEGAR = "kavenegar";

    protected $smsEntity;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $smsProvider = Config::get('app.SMS_PROVIDER', self::KAVENEGAR);

        $this->app->when(SmsController::class)
            ->needs(SmsInterface::class)
            ->give(function () use ($smsProvider) {

                $smsEntityManager = ucfirst($smsProvider);

                $className = 'App\Services\SMS\\' . $smsEntityManager . '\\' . $smsEntityManager . 'SmsPanel';

                if (class_exists($className)) {
                    return new $className;
                }

                throw new NotFoundHttpException();
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
