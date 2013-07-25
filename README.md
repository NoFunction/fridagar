# fridagar
========

Generate Icelandic holidays and create iCalendar for them, for easy importing to Google Calendar.

## Class usage

	Holidays ( mixed $years [, string $dateFormat ] )
	
- `$years` can both be an `integer` (representing one year) and an `array` of integers (representing a range of years)
- `$dateFormat` can be an optional [date format](http://us.php.net/manual/en/function.date.php)

## Getting started

**Remember to include class libraries**

	// Class libraries
	require_once('classes/Holidays.class.php');
	require_once('classes/HolidayEvent.class.php');
	
## Three output methods

- Output text
  - `$holidays->printOut();`
- Output iCal calendar file
  - `$holidays->printiCal();`
- Output array to a variable
  - `$holidayArr = $holidays->getHolidays();`
	
## One year

	// Get holidays for the year 2013
	// Returns UNIX timestamp
	$holidays = new Holidays(2013);

	// Get array of the holidays for the year 2013
	$holidayArr = $holidays->getHolidays();

	// Print out holidays as text for the year
	$holidays->printOut();
	
	// Print out iCalendar for the year
	$holidays->printiCal();
	
## Multiple years

	// Get holidays for the years 2013, 2014, 2015, 2016
	$holidays = new Holidays(array(2013,2014,2015,2016));

	// Get array of the holidays for the year range
	$holidayArr = $holidays->getHolidays();

	// Print out holidays as text for the year range
	$holidays->printOut();

	// Print out iCalendar for the year range
	$holidays->printiCal();
	
## Working with iCal

When using `printiCal()` method, remember to set `text/calendar` headers before:

	// Make document a calendar file
	header('Content-type: text/calendar; charset=utf-8');
	
	// Optional: To save a filename
	header('Content-Disposition: inline; filename=fridagar.ics');
	
## Date formatting

	// Get holidays for the year 2013 in the date format "d. M Y"
	$holidays = new Holidays(2013, 'd. M Y');
	
	// Get array of the holidays for the year in the date format "d. M Y"
	$holidayArr = $holidays->getHolidays();

	// Print out holidays as text for the year in the date format "d. M Y"
	$holidays->printOut();

	// Print out iCalendar for the year range in the date format "d. M Y"
	$holidays->printiCal();