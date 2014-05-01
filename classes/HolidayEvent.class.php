<?php
class HolidayEvent
{
	private $_date;
	private $_event;
	private $_isHoliday;

	public function __construct($date, $event, $isHoliday = false)
	{
		$this->_date = $date;
		$this->_event = $event;
		$this->_isHoliday = $isHoliday;
	}

	public function getEvent()
	{
		return $this->_event;
	}

	public function getStartDate()
	{
		return $this->_date;
	}

	public function getEndDate()
	{
		return strtotime('+1 day', $this->_date);
	}
	
	public function setDate($date)
	{
		$this->_date = $date;
	}

	public function isHoliday()
	{
		return $this->_isHoliday;
	}
};
?>