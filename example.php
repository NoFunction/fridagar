<?php
/*
	EXAMPLE:
	
	Get holidays for one/multiple years

	CLASS USAGE:

	Holidays ( mixed $years [, string $dateFormat ] )
	* $years can both be an integer and an array of integers
	* $dateFormat can be an optional date format
	  ( see: http://us.php.net/manual/en/function.date.php )
*/

// Class libraries
require_once('classes/Holidays.class.php');
require_once('classes/HolidayEvent.class.php');

/*
	Get one year
*/

// Get holidays for the year 2013
// Returns UNIX timestamp
$holidays = new Holidays(2013);

// Get array of the holidays for the year 2013
$holidayArr = $holidays->getHolidays();

// Print out holidays for the year 2013
$holidays->printOut();

/*
	Print holidays of one year with date format 'd. M Y'
*/

$holidays = new Holidays(2013, 'd. M Y');

// Print out holidays for the year 2013
$holidays->printOut();

/*
	Get multiple years
*/

// Get holidays for the years 2013, 2014, 2015, 2016
$holidays = new Holidays(array(2013,2014,2015,2016));

// Get array of the holidays for the years 2013, 2014, 2015, 2016
$holidayArr = $holidays->getHolidays();

// Print out holidays for the years 2013, 2014, 2015, 2016
$holidays->printOut();
?>