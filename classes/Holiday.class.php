<?php
class Holiday
{
	private $_date;
	private $_event;

	public function __construct($date, $event)
	{
		$this->_date = $date;
		$this->_event = $event;
	}

	public function getDate()
	{
		return $this->_date;
	}

	public function getEvent()
	{
		return $this->_event;
	}
};
?>