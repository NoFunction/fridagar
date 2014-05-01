<?php
/*
	EXAMPLE:
	
	Save holidays for the years 2013, 2014, 2015, 2016
	as an iCalendar file
*/

// Class libraries
require_once('classes/Holidays.class.php');
require_once('classes/HolidayEvent.class.php');

// Get current year
$curYear = date('Y');

// How many years we want, if more than 100 we set default to 5
$yearCount = is_numeric($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] <= 100 ? $_SERVER['QUERY_STRING'] : 5;

// Put next 5 years in an array
for($i = $curYear; $i <= $curYear + $yearCount; $i++)
	$holidays[] = $i;

// Get the holidays
$holidays = new Holidays($holidays, 'd/m/Y');

// Loop through each year
foreach($holidays->getHolidays() as $years)
{
	// Loop through each holiday
	foreach($years as $holiday)
	{
		// Customized output
		//echo $holiday->getEvent() . ' will be: ' . date('d/m/Y', $holiday->getStartDate()) . '<br />';
	}
}

if($_SERVER['QUERY_STRING'] == 'ics')
{
	// Set headers for calendar format
	header('Content-type: text/calendar; charset=utf-8');
	header('Content-Disposition: inline; filename=fridagar.ics');

	// Print out iCalendar
	$holidays->printiCal();
}
elseif($_SERVER['QUERY_STRING'] == 'src')
	highlight_file(__FILE__);
else
	$holidays->printOut();
?>