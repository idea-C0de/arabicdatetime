<?php namespace Maherelgamil\Arabicdatetime;
/**
 *
 * @author maherbusnes@gmail.com
 *
 */
class Arabicdatetime
{

    protected  $arabicMonths = [

        "Jan" => "يناير",
        "Feb" => "فبراير",
        "Mar" => "مارس",
        "Apr" => "أبريل",
        "May" => "مايو",
        "Jun" => "يونيو",
        "Jul" => "يوليو",
        "Aug" => "أغسطس",
        "Sep" => "سبتمبر",
        "Oct" => "أكتوبر",
        "Nov" => "نوفمبر",
        "Dec" => "ديسمبر"

    ] ;


    protected  $arabicDay = [

        "السبت", "الأحد",
        "الإثنين",
        "الثلاثاء",
        "الأربعاء",
        "الخميس",
        "الجمعة"
    ] ;


    protected  $englishDay = [

        "Sat",
        "Sun",
        "Mon",
        "Tue",
        "Wed" ,
        "Thu",
        "Fri"

    ];

    protected  $period = [
        'am' => 'صباحا' ,
        'pm' => 'مساءا'

    ] ;

    protected  $indianNum = ["٠","١","٢","٣","٤","٥","٦","٧","٨","٩"] ;

    protected  $arabicNum = ["0","1","2","3","4","5","6","7","8","9"] ;


    protected  $numericMode = 'indian' ; //arabic || indian

    protected  $hourArabicTitle = 'الساعه' ;


    /**
     * Get english date from unixtime
     *
     * @param unixtime $unixtime
     *
     * @return string contain date
     *
     */
    protected function getEnglishDate($unixtime)
    {
        return date("F j, Y, g:i a" , $unixtime ); ;
    }


    /**
     * Get arabic date from unixtime
     *
     * @param unixtime $unixtime
     *
     * @return string contain date
     *
     */
    protected function getArabicDate($unixtime)
    {
        //1get month
        $month =  $this->arabicMonths[date("M", $unixtime )] ;


        //get day
        $day  = str_replace($this->englishDay, $this->arabicDay, date('D' , $unixtime));


        //get time
        $time = date('H:i' , $unixtime );

        //get am or pm
        $period = $this->period[date('a' , $unixtime )];

        $fullTime = $this->hourArabicTitle . " ($time)" . ' ' . $period ;

        //get full date
        $current_date = $fullTime . ' - ' . $day . ' ' . date('d') . ' / ' . $month . ' / ' .date('Y');


        if($this->numericMode == 'indian'){
            $date = str_replace($standard , $eastern_arabic_symbols , $current_date);
        }else{
            $date = $current_date ;
        }

        return $date ;


    }


    /**
     * Get hijri date from unixtime
     *
     * @param unixtime $unixtime
     *
     * @return string contain date
     *
     */
    protected function getHijriDate($unixtime)
    {
        return "hijri-date-suppoted-comming-soon";
    }

    /**
     * Get date in Arabic
     *
     * @param string $unixtime time
     * @param int $mode 0 english || 1 arabic || 2 hijri
     *
     * @author maherbusnes@gmail.com
     *
     *
     * @return string contain date
     */
    public  function  date($unixtime , $mode = 0 )
    {
        if($mode == 0){
            //english
            $date =  $this->getEnglishDate($unixtime);
        }elseif($mode == 1){
            //arabic
            $date = $this->getArabicDate($unixtime);

        }elseif($mode == 2){
            //hijri
            $date = $this->getHijriDate($unixtime);
        }


        return $date ;
    }


    public function getArabicMonthes()
    {
        return $this->arabicMonths ;
    }

    public function getArabicDays()
    {
        return $this->arabicDay ;
    }

    public function remainnigTime($unixtime , $locale = 'ar')
    {
        $seconds = $unixtime - time();

        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        if($locale == 'ar')
        {

            $remaining = ($days    > 0 ? $days    .' يوم و'   : '' ) .
                ($hours   > 0 ? $hours   .' ساعه و'  : '' ) .
                ($minutes > 0 ? $minutes .' دقيقة و' : '' ) .
                ($seconds > 0 ? $seconds .' ثانيه '  : '' ) ;
        }else{
            $remaining = ($days    > 0 ? $days    .' days and'   : '' ) .
                ($hours   > 0 ? $hours   .' hours and'  : '' ) .
                ($minutes > 0 ? $minutes .' minutes and' : '' ) .
                ($seconds > 0 ? $seconds .' seconds'  : '' ) ;
        }


        return $remaining ;
    }



}



?>