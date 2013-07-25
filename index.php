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
// Put next 5 years in an array
for($i = $curYear; $i < $curYear + 5; $i++)
	$holidays[] = $i;

// Get the holidays
$holidays = new Holidays($holidays);

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