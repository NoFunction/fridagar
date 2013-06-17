<?php
// Class files
require_once('iCal.class.php');
require_once('iCalEvent.class.php');

// Set headers for genuine iCalendar authenticity
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=fridagar.ics');

// Content, make sure we get latin-1
$content = file_get_contents('http://www.lanamal.is/fagfjarfestar/fridagar');
$content = utf8_decode($content);

// Parsing
$dom = new DOMDocument();
@$dom->loadHTML($content);
$xpath = new DOMXPath($dom);

// XPath to our events
$entries = $xpath->query('//div[@class="content"]/table/tbody/tr/td/table/tbody/tr/td/table/tbody/tr');

// iCalendar object
$iCal = new iCal();

// Go through each event row and add to our iCalendar
foreach($entries as $entry)
{
	// The date
	$date = $entry->childNodes->item(0)->nodeValue;
	// The event
	$event = $entry->childNodes->item(2)->nodeValue;

	// If current year is not in the date or the event is empty, we skip it
	if(!strpos($date, date('Y')) || $event == '')
		continue;
	
	// Create the object and add it to our iCal
	$eventObj = new iCalEvent($date, $event);
	
	$iCal->addEvent($eventObj);
}

// Print the iCal out
$iCal->printiCal();
?>