<?php namespace App\Helpers;


Class DateUtil
{
    private static $GREGORIAN_EPOCH = 1721425.5;
    private static $PERSIAN_EPOCH = 1948320.5;

    private static $shamsiMonthName = [
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
        '01' => 'فروردین',
        '02' => 'اردیبهشت',
        '03' => 'خرداد',
        '04' => 'تیر',
        '05' => 'مرداد',
        '06' => 'شهریور',
        '07' => 'مهر',
        '08' => 'آبان',
        '09' => 'آذر',
    ];
    private static $gregorianMonthName = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
    ];

    /**
     * @param $dateTime
     * @param string $dateSeperator
     * @param bool $with_seconds
     * @return string
     */
    public static function getShamsiDBDateTimeFromGregorianDBDateTime($dateTime, $dateSeperator = "-", $with_seconds = true)
    {
        if (Util::is_set($dateTime)) {
            $tmp = $dateTime;
            $array = explode(" ", $tmp);
            $date = $array[0];
            $time = $array[1];

            if (!$with_seconds) {
                $time = substr($time, 0, 5);
            }

            return self::getShamsiDBDateFromGregorianDBDate($date, $dateSeperator) . " " . $time;
        } else
            return '';
    }

    /**
     * @param $date
     * @param string $seperator
     * @return string
     */
    public static function getShamsiDBDateFromGregorianDBDate($date, $seperator = "-")
    {
        if (Util::is_set($date)) {
            $tmp = $date;
            $array = explode($seperator, $tmp);
            $year = $array[0];
            $month = $array[1];
            $day = $array[2];

            return self::getShamsiDateFromGregorian($year, $month, $day, $seperator);
        } else
            return '';
    }

    /**
     * @param $gregorianYear
     * @param $gregorianMonth
     * @param $gregorianDay
     * @param string $seperator
     * @param bool $withMonthName
     * @return string
     */
    public static function getShamsiDateFromGregorian($gregorianYear, $gregorianMonth, $gregorianDay, $seperator = " ", $withMonthName = false)
    {
        $pDate = self::jd_to_persian(self::gregorian_to_jd($gregorianYear, $gregorianMonth, $gregorianDay));
        $Pyear = $pDate[0];
        $Pmonth = $pDate[1];
        $Pday = $pDate[2];
        if ($withMonthName)
            return ($Pday . $seperator . self::$shamsiMonthName[$Pmonth] . $seperator . $Pyear);
        else {
            if ($Pmonth < 10)
                $Pmonth = '0' . $Pmonth;
            if ($Pday < 10)
                $Pday = '0' . $Pday;
            return ($Pyear . $seperator . $Pmonth . $seperator . $Pday);
        }
    }

    /**
     * @param $jd
     * @return array
     */
    private static function jd_to_persian($jd)
    {
        $jd = floor($jd) + 0.5;

        $depoch = $jd - self::persian_to_jd(475, 1, 1);
        $cycle = floor($depoch / 1029983);
        $cyear = ($depoch % 1029983);
        if ($cyear == 1029982) {
            $ycycle = 2820;
        } else {
            $aux1 = floor($cyear / 366);
            $aux2 = ($cyear % 366);
            $ycycle = floor(((2134 * $aux1) + (2816 * $aux2) + 2815) / 1028522) + $aux1 + 1;
        }
        $year = (int)($ycycle + (2820 * $cycle) + 474);
        if ($year <= 0) {
            $year--;
        }
        $yday = ($jd - self::persian_to_jd($year, 1, 1)) + 1;
        $month = (int)(($yday <= 186) ? ceil($yday / 31) : ceil(($yday - 6) / 30));
        $day = (int)(($jd - self::persian_to_jd($year, $month, 1)) + 1);
        $myarray = [(int)$year, (int)$month, (int)$day];
        return $myarray;
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return float|int
     */
    private static function gregorian_to_jd($year, $month, $day)
    {
        return (self::$GREGORIAN_EPOCH - 1) +
            (365 * ($year - 1)) +
            floor(($year - 1) / 4) +
            (-floor(($year - 1) / 100)) +
            floor(($year - 1) / 400) +
            floor((((367 * $month) - 362) / 12) +
                (($month <= 2) ? 0 : (self::leap_gregorian($year) ? -1 : -2)) + $day);
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return float|int
     */
    private static function persian_to_jd($year, $month, $day)
    {
        $epbase = $year - (($year >= 0) ? 474 : 473);
        $epyear = 474 + ($epbase % 2820);

        return $day +
            (($month <= 7) ?
                (($month - 1) * 31) :
                ((($month - 1) * 30) + 6)
            ) +
            floor((($epyear * 682) - 110) / 2816) +
            ($epyear - 1) * 365 +
            floor($epbase / 2820) * 1029983 +
            (self::$PERSIAN_EPOCH - 1);
    }

    /**
     * @param $year
     * @return bool
     */
    private static function leap_gregorian($year)
    {
        return (($year % 4) == 0) && (!((($year % 100) == 0) && (($year % 400) != 0)));
    }

}
