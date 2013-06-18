<?php
require_once('classes/iCal.class.php');
require_once('classes/iCalEvent.class.php');

// Years we want to calculate holidays for
$years = array(2013, 2014);

$holidaysObj = new Holidays($years);
foreach($holidaysObj->getHolidays() as $year => $holidays)
{
	echo '<h2>' . $year . '</h2>';
	foreach($holidays as $holiday)
	{
		echo $holiday->getEvent() . ' = ' . date('d.m.Y', $holiday->getDate()) . '<br />';
	}
}
?>