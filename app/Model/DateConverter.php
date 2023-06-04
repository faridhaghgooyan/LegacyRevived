<?php
namespace App\Model;
class DateConverter {

    public $gMonthDays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    public $jMonthDays = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


    /**
     * Simple divider.
     *
     */
    private function div($a,$b) {
        return (int) ($a / $b);
    }


    /**
     * Converts Gregorian date to Jalali date.
     *
     * @ 4 arguments
     *	1- year
     *	2- month
     * 3- day
     * 4- bool (true return string, false returns array)
     */
    public function toJalali ($g_y, $g_m, $g_d,$str)
    {
        $gy = $g_y-1600;
        $gm = $g_m-1;
        $gd = $g_d-1;

        $g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400);

        for ($i=0; $i < $gm; ++$i)
            $g_day_no += $this->gMonthDays[$i];
        if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
            /* leap and after Feb */
            $g_day_no++;
        $g_day_no += $gd;

        $j_day_no = $g_day_no-79;

        $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
        $j_day_no = $j_day_no % 12053;

        $jy = 979+33*$j_np+4*$this->div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */

        $j_day_no %= 1461;

        if ($j_day_no >= 366) {
            $jy += $this->div($j_day_no-1, 365);
            $j_day_no = ($j_day_no-1)%365;
        }

        for ($i = 0; $i < 11 && $j_day_no >= $this->jMonthDays[$i]; ++$i)
            $j_day_no -= $this->jMonthDays[$i];
        $jm = $i+1;
        $jd = $j_day_no+1;
        if($str) return $jy.'/'.$jm.'/'.$jd ;
        return array($jy, $jm, $jd);
    }



    /**
     * Converts Jalali date to Gregorian date.
     *
     * @ 4 arguments
     *	1- year
     *	2- month
     * 3- day
     * 4- bool (true return string, false returns array)
     */
    public function toGregorian($j_y, $j_m, $j_d,$str)
    {
        $jy = (int)($j_y)-979;
        $jm = (int)($j_m)-1;
        $jd = (int)($j_d)-1;

        $j_day_no = 365*$jy + $this->div($jy, 33)*8 + $this->div($jy%33+3, 4);

        for ($i=0; $i < $jm; ++$i)
            $j_day_no += $this->jMonthDays[$i];

        $j_day_no += $jd;

        $g_day_no = $j_day_no+79;

        $gy = 1600 + 400*$this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
        $g_day_no = $g_day_no % 146097;

        $leap = true;
        if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
        {
            $g_day_no--;
            $gy += 100*$this->div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
            $g_day_no = $g_day_no % 36524;

            if ($g_day_no >= 365)
                $g_day_no++;
            else
                $leap = false;
        }

        $gy += 4*$this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
        $g_day_no %= 1461;

        if ($g_day_no >= 366) {
            $leap = false;

            $g_day_no--;
            $gy += $this->div($g_day_no, 365);
            $g_day_no = $g_day_no % 365;
        }

        for ($i = 0; $g_day_no >= $this->gMonthDays[$i] + ($i == 1 && $leap); $i++)
            $g_day_no -= $this->gMonthDays[$i] + ($i == 1 && $leap);
        $gm = $i+1;
        $gd = $g_day_no+1;
        if($str) return $gy.'/'.$gm.'/'.$gd ;
        return array($gy, $gm, $gd);
    }

    /**
     * Compares Jalali date to Gregorian date.
     *
     * @ 2 arguments
     *	1- jalali date (string)
     *	2- gregorian date (string)
     */
    public function compareDate($_date_mix_jalaly,$_date_mix_gregorian)
    {
        $_date_arr_jalaly = explode('/', $_date_mix_jalaly);
        $_date_arr_gregorian = explode('/', $_date_mix_gregorian);

        $arr_jtg = $this->toGregorian($_date_arr_jalaly[0],$_date_arr_jalaly[1],$_date_arr_jalaly[2],false);

        if($_date_arr_gregorian[0]> $arr_jtg[0])
        {
            return  false;
        }

        else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]>$arr_jtg[1])
        {
            return false;
        }
        else if($_date_arr_gregorian[0]== $arr_jtg[0] && $_date_arr_gregorian[1]==$arr_jtg[1] && $_date_arr_gregorian[2]>$arr_jtg[2])
        {
            return false;
        }
        return true ;
    }

    public function dateConvert($timestamp){
        $date = date("m/d/Y ",strtotime($timestamp));
        $time = date("H:i:s ",strtotime($timestamp));
        $date_slice = explode('/', $date);

        $jalali_Date = $this->toJalali((int)$date_slice[2], (int)$date_slice[0], (int)$date_slice[1], $date);
        $result = array([
            "date" => $jalali_Date,
            "time" => $time
        ]);


        return $result;
    }
    public function date_convert($input_data,$type): array
    {
        $date = date("Y-m-d ",strtotime($input_data));
        $time = date("H:i:s ",strtotime($input_data));

        switch ($type){
            case 'jalali':
                $date_slice = explode('-', $date);
                $jalali_Date = self::toJalali((int)$date_slice[0], (int)$date_slice[1], (int)$date_slice[2], $date);
                $result = array([
                    "date" => str_replace('/','-',$jalali_Date),
                    "time" => $time
                ]);
                break;
            case 'georgian':
                $date_slice = explode('-', $date);

                $georgian_date = self::toGregorian((int)$date_slice[0], (int)$date_slice[1], (int)$date_slice[2], $date);
                $result = array([
                    "date" => str_replace('/','-',$georgian_date),
                    "time" => $time
                ]);

                break;

        }




        return $result;
    }


}