<?php
class iCal
{
	private $_events = array();
	
	public function __construct()
	{
		$this->_events = array();
	}
	
	public function addEvent($event)
	{
		array_push($this->_events, $event);
	}
	
	public function printiCal()
	{
		echo $this->getiCalHeader();
		echo $this->getiCalEvents();
		echo $this->getiCalFooter();
	}
	
	public function getiCalEvents()
	{
		foreach($this->_events as $event)
		{
			$output .= "BEGIN:VEVENT\r\n";
			$output .= "DTSTART;VALUE=DATE:" . $event->getiCalDateStart() . "\r\n";
			$output .= "DTEND;VALUE=DATE:" . $event->getiCalDateEnd() . "\r\n";
			$output .= "DTSTAMP:" . $event->getiCalDateStart() . "T000000Z\r\n";
			$output .= "SUMMARY:" . $event->getEvent() . "\r\n";
			$output .= "END:VEVENT\r\n";
		}
		
		return $output;
	}
	
	public function getiCalHeader()
	{
		$output .= "BEGIN:VCALENDAR\r\n";
		$output .= "VERSION:2.0\r\n";
		$output .= "PRODID:-//Google Inc//Google Calendar 70.9054//EN\r\n";
		$output .= "CALSCALE:GREGORIAN\r\n";
		$output .= "METHOD:PUBLISH\r\n";
		$output .= "X-WR-CALNAME:Fridagar\r\n";
		$output .= "X-WR-TIMEZONE:Atlantic/Reykjavik\r\n";
		$output .= "X-WR-CALDESC:\r\n";
		
		return $output;
	}
	
	public function getiCalFooter()
	{
		return "END:VCALENDAR\r\n";
	}
};
?>