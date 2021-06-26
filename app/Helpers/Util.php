<?php namespace App\Helpers;

use App\Models\CultureType;

Class Util
{
    /**
     * @param $variable
     * @return bool
     */
    public static function is_set($variable)
    {
        if (!isset($variable) || is_null($variable) || $variable == '')
            return false;
        else
            return true;
    }

    /**
     * @param $date
     * @param null $culture_desc
     * @param bool $db_format
     * @param null $font_size
     * @param bool $with_time
     * @param bool $with_seconds
     * @param bool $mobileView
     * @param bool $i18nNumber
     * @return bool|mixed|null|string
     */
    public static function i18n_date2($date, $culture_desc = null, $db_format = false, $font_size = null, $with_time = false, $with_seconds = true, $mobileView = false, $i18nNumber = false)
    {
        if ($date == NULL || $date == '' || $date == '0000-00-00 00:00:00' || $date == '0000-00-00') return null;

        if (!$culture_desc) $culture_desc = CultureType::FA;
        if ($culture_desc == CultureType::FA || $culture_desc == 'jalali') {
            if ($db_format) {
                if ($with_time) {
                    return DateUtil::getShamsiDBDateTimeFromGregorianDBDateTime($date, '-', $with_seconds);
                } else {
                    return DateUtil::getShamsiDBDateFromGregorianDBDate(substr($date, 0, 10));
                }
            } else {

                if ($with_time) {
                    $x = str_replace('-', '/', DateUtil::getShamsiDBDateTimeFromGregorianDBDateTime($date, '-', $with_seconds));
                } else {
                    $x = str_replace('-', '/', DateUtil::getShamsiDBDateFromGregorianDBDate(substr($date, 0, 10)));
                }

                if ($mobileView) {
                    $x = substr($x, 2);
                }

                if ($i18nNumber == true) {
                    $x = self::i18n_number($x, $culture_desc);
                }

                return $x;
            }
        } else {

            $x = substr($date, 0, 10);

            if ($mobileView) {
                $x = substr($x, 2);
            }

            if ($i18nNumber == true) {
                $x = self::i18n_number($x, $culture_desc);
            }

            return $x;
        }
    }

    /**
     * @param $number
     * @param null $culture_desc
     * @return string
     */
    public static function i18n_number($number, $culture_desc = null)
    {
        if (!$culture_desc) $culture_desc = CultureType::FA;
        if ($culture_desc == CultureType::FA) {
            return Util::numberToFarsi($number);
        } else {
            return $number;
        }
    }

    public static function numberToFarsi($number)
    {
        $fnumber = "";
        $s = $number;
        for ($i = 0; $i < strlen($s); $i = $i + 1) {
            $fnumber .= self::numberToFarsi2(substr($s, $i, 1));
        }
        return $fnumber;
    }

    /**
     * @param $c
     * @return string
     */
    private static function numberToFarsi2($c)
    {
        switch ($c) {
            case '0':
                return '٠';
            case '1':
                return '۱';
            case '2':
                return '۲';
            case '3':
                return '٣';
            case '4':
                return '۴';
            case '5':
                return '۵';
            case '6':
                return '٦';
            case '7':
                return '٧';
            case '8':
                return '٨';
            case '9':
                return '۹';
            default:
                return $c;
        }
    }

}
