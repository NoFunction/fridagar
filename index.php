<?php
require_once('classes/Holidays.class.php');
require_once('classes/HolidayEvent.class.php');

// Years we want to calculate holidays for
$holidaysObj = new Holidays(2013);
print_r($holidaysObj->getHolidays());
//$holidaysObj->printOut();
//$holidaysObj->printiCal();
?>