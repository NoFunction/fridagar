<?php
/*
	EXAMPLE:
	
	Save holidays for the years 2013, 2014, 2015, 2016
	as an iCalendar file
*/

// Class libraries
require_once('classes/Holidays.class.php');
require_once('classes/HolidayEvent.class.php');

// Set headers
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=fridagar.ics');

// Get holidays for the years 2013, 2014, 2015, 2016
$holidays = new Holidays(array(2013,2014,2015,2016));

// Print out iCalendar for the years 2013, 2014, 2015, 2016
$holidays->printiCal();
?>