<?php
class iCalEvent
{
	private $_event;
	private $_date;

	public function __construct($date, $event)
	{
		$this->_event = $event;
		$this->_date = $date;
		
		// Replace &nbsp; to space
		$date = str_replace('&nbsp;', ' ', $date);
		$date = str_replace("\xc2\xa0", " ", $date);
	
		list($day, $month, $year) = explode(' ', $date);
		$this->_date = strtotime($day . ' ' . $this->getMonth($month) . ' ' . $year);
	}
	
	private function getMonth($month)
	{
		// Fix for typo on webpage
		$month = str_replace('marsl', 'mars', $month);
	
		$months = array(
					'janúar' => 'January',
					'febrúar' => 'February',
					'mars' => 'March',
					'apríl' => 'April',
					'maí' => 'May',
					'júní' => 'June',
					'júlí' => 'July',
					'ágúst' => 'August',
					'september' => 'September',
					'október' => 'October',
					'nóvember' => 'November',
					'desember' => 'December'
		);
		
		return $months[$month];
	}
	
	public function getEvent()
	{
		return $this->_event;
	}
	
	public function getiCalDateStart()
	{
		return date('Ymd', $this->_date);
	}
	
	public function getiCalDateEnd()
	{
		$newTimestamp = strtotime('+1 day', $this->_date);
		return date('Ymd', $newTimestamp);
	}
};
?>