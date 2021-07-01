<?php


namespace App\Services\SMS\Mellipayamak;


use App\Services\SMS\Base\SmsPanelRepository;
use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Config;

class MellipayamakSmsPanel implements SmsInterface
{

    public $sender;
    public $app;

    use Melipayamak;

    /**
     * MellipayamakSmsPanel constructor.
     * @param $app
     */
    public function __construct($app)
    {
        //I don't access to mellipayamak panel, finally we set mellipayamak properties here,
        //like SMS_HOST or SMS_API_KEY and ...

        $this->app = $app;
        $this->sender = Config::get('app.MELLIPAYAMAK_SENDER');
    }

    /**
     * @param $to
     * @param $text
     * @param $smsEntityManager
     * @return mixed
     */
    public function sendSms($to, $text, $smsEntityManager)
    {
        if ($this->app->config['app']['SMS_PROVIDER'] == $smsEntityManager) {

            try {
                $sms = Melipayamak::sms();

                $response = $sms->send($to, $this->sender, $text);

                $json = json_decode($response);
                return $json->Value; //RecId or Error Number

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

}
