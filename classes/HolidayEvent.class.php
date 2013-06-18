<?php
class HolidayEvent
{
	private $_date;
	private $_event;

	public function __construct($date, $event)
	{
		$this->_date = $date;
		$this->_event = $event;
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
};
?>