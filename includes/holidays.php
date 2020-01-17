<?php
class US_Federal_Holidays
{
    private $year, $list;
    const ONE_DAY = 86400; // Number of seconds in one day
 
    function __construct($year = null, $timezone = 'America/Chicago')
    {
    	try 
    	{
            if (! date_default_timezone_set($timezone))
            {
                throw new Exception($timezone.' is not a valid timezone.');		    
            }
 
            $this->year = (is_null($year))? (int) date("Y") : (int) $year;
            if (! is_int($this->year) || $this->year < 1997)
            {
                throw new Exception($year.' is not a valid year. Valid values are integers greater than 1996.');
            }
        
            $this->set_list();
        }
 
        catch(Exception $e)
        {
            echo $e->getMessage();
            exit();
        }
    }
 
    private function adjust_fixed_holiday($timestamp)
    {
        $weekday = date("w", $timestamp);
        if ($weekday == 0)
        {
            return $timestamp + self::ONE_DAY;
        }
        if ($weekday == 6)
        {
            return $timestamp - self::ONE_DAY;
        }
        return $timestamp;
    }
 
    private function set_list()
    {
        $this->list = array
        (
            array
            (
                "name" => "New Year's Day", 
                        // January 1st, if not Saturday/Sunday
                "timestamp" => $this->adjust_fixed_holiday(mktime(0, 0, 0, 1, 1, $this->year))
                ), 
            array
            (
                "name" => "Birthday of Martin Luther King, Jr.", 
                        // 3rd Monday of January
                "timestamp" => strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $this->year))
                ),
            array
            (
                "name" => "Wasthington's Birthday", 
                        // 3rd Monday of February
                "timestamp" => strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $this->year))
                ),
            array
            (
                "name" => "Memorial Day ", 
                        // last Monday of May
                "timestamp" => strtotime("last Monday of May $this->year")
                ),
            array
            (
                "name" => "Independence day ", 
                        // July 4, if not Saturday/Sunday
                "timestamp" => $this->adjust_fixed_holiday(mktime(0, 0, 0, 7, 4, $this->year))
                ),
            array
            (
                "name" => "Labor Day ", 
                        // 1st Monday of September
                "timestamp" => strtotime("first Monday of September $this->year")
                ),
            array
            (
                "name" => "Columbus Day ", 
                        // 2nd Monday of October
                "timestamp" => strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $this->year))
                ),
            array
            (
                "name" => "Veteran's Day ",
                        // November 11, if not Saturday/Sunday
                "timestamp" => $this->adjust_fixed_holiday(mktime(0, 0, 0, 11, 11, $this->year))
                ),  
            array
            (
                "name" => "Thanksgiving Day ", 
                        // 4th Thursday of November
                "timestamp" => strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $this->year))
                ),
            array
            (
                "name" => "Christmas ", 
                        // December 25 every year, if not Saturday/Sunday
                "timestamp" => $this->adjust_fixed_holiday(mktime(0, 0, 0, 12, 25, $this->year))
            )
        );
    }
 
    public function get_list()
    {
        return $this->list;
    }
 
    public function is_holiday($timestamp)
    {
        foreach ($this->list as $holiday)
        {
           if ($timestamp == $holiday["timestamp"]) return true;
        }
    
        return false;
    }
}
?>