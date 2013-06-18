<?php
require_once('classes/Holiday.class.php');
require_once('classes/Holidays.class.php');
require_once('classes/iCal.class.php');
require_once('classes/iCalEvent.class.php');

$allYears = explode(',', $_SERVER['QUERY_STRING']);

if(count($allYears) > 10)
	die('Við skulum aðeins hafa okkur hæg.');

$holidaysObj = new Holidays($allYears);
foreach($holidaysObj->getHolidays() as $year => $holidays)
{
	echo '<h2>' . $year . '</h2>';
	foreach($holidays as $holiday)
	{
		echo $holiday->getEvent() . ' = ' . date('d.m.Y', $holiday->getDate()) . '<br />';
	}
}
?>