<?php
date_default_timezone_set('Iceland');
class Holidays
{
	private $_years;
	private $_holidays;

	// Constructor
	public function __construct($years, $dateFormat = null)
	{
		if(!is_array($years))
			$years = array($years);

		$this->_years = $years;
		$this->_holidays = array();
		$this->_dateFormat = $dateFormat;
		
		// Parse the year input
		$this->parse($years);
	}
	
	// Parses all years to holiday event objects
	private function parse($years)
	{
		foreach($years as $year)
		{
			$this->_holidays[$year] = array();

			// N��rsdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(1, 1, $year),
					'N��rsdagur',
					true
				)
			);

			// �r�tt�ndi
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(6, 1, $year),
					'�rett�ndinn'
				)
			);

			// B�ndadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->winterDate($year, 13, 5),
					'B�ndadagur'
				)
			);

			// Bolludagur
			$temp = $this->easterDate($year, -(7*7));
			$tempDay = 7 - date('N', $temp) - 1 % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('-' . $tempDay . ' days', $temp),
					'Bolludagur'
				)
			);

			// Sprengidagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('-' . ($tempDay-1) . ' days', $temp),
					'Sprengidagur'
				)
			);

			// �skudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('-' . ($tempDay-2) . ' days', $temp),
					'�skudagur'
				)
			);

			// Konudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->winterDate($year, 18, 7),
					'Konudagur'
				)
			);

			// Sk�rdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, -3),
					'Sk�rdagur',
					true
				)
			);

			// F�studagurinn langi
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, -2),
					'F�studagurinn langi',
					true
				)
			);

			// P�skadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year),
					'P�skadagur',
					true
				)
			);

			// Annar � p�skum
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 1),
					'Annar � p�skum',
					true
				)
			);

			// Sumardagurinn fyrsti
			$temp = $this->getStartdate(19, 4, $year);
			$tempDay = (7 - date('N', $temp) + 4) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Sumardagurinn fyrsti',
					true
				)
			);

			// Verkal��sdagurinn
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(1, 5, $year),
					'Verkal��sdagurinn',
					true
				)
			);

			// Uppstigningardagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 39),
					'Uppstigningardagur',
					true
				)
			);

			// Hv�tasunnudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 49),
					'Hv�tasunnudagur',
					true
				)
			);

			// Annar � Hv�tasunnu
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 50),
					'Annar � Hv�tasunnu',
					true
				)
			);

			// Sj�mannadagurinn
			$temp = $this->getStartdate(1, 6, $year);
			$tempDay = (7 - date('N', $temp)) % 7;
			$tempTime = strtotime('+' . $tempDay . ' days', $temp);
			$easterSunday = $this->easterDate($year, 49);
			if (date('dm', $easterSunday) == date('dm', $tempTime)) {
				$tempDay += 7;
			}
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Sj�mannadagurinn'
				)
			);

			// �j��h�t��ardagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(17, 6, $year),
					'�j��h�t��ardagur',
					true
				)
			);

			// Fr�dagur verslunarmanna
			$temp = $this->getStartdate(1, 8, $year);
			$tempDay = (7 - date('N', $temp) + 1) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Fr�dagur verslunarmanna',
					true
				)
			);

			// Verslunarmannahelgi
			$temp = $this->getStartdate(1, 8, $year);
			$tempDay = (7 - date('N', $temp) + 5) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Verslunarmannahelgi'
				)
			);

			// �orl�ksmessa
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(23, 12, $year),
					'�orl�ksmessa'
				)
			);

			// A�fangadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(24, 12, $year, 13),
					'A�fangadagur',
					true
				)
			);

			// J�ladagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(25, 12, $year),
					'J�ladagur',
					true
				)
			);

			// Annar � J�lum
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(26, 12, $year),
					'Annar � J�lum',
					true
				)
			);

			// Gaml�rsdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(31, 12, $year, 13),
					'Gaml�rsdagur',
					true
				)
			);
		}
	}

	public function getHolidays()
	{
		$temp = [];
		foreach($this->_holidays as $year => $holidays)
		{
			foreach($holidays as $holiday)
			{
				$temp[$year][] = clone $holiday;
				$temp[$year][count($temp[$year])-1]->setDate($this->formatDate($temp[$year][count($temp[$year])-1]->getStartDate()));
			}
		}
		
		return $temp;
	}

	public function printOut()
	{
		foreach($this->_holidays as $year => $holidays)
		{
			echo '<h2>' . $year . '</h2>';
			foreach($holidays as $holiday)
			{
				echo $holiday->getEvent() . ' = ' . $this->formatDate($holiday->getStartDate()) . ($holiday->isHoliday() ? ' (fr�dagur)' : '');

				echo '<br />';
			}
		}
	}

	private function formatDate($date)
	{
		if($this->_dateFormat == null)
			$theDate = $date;
		else
			$theDate = date($this->_dateFormat, $date);

		return $theDate;
	}

	private function getStartDate($day, $month, $year, $hour = 0)
	{
		return gmmktime($hour, 0, 0, $month, $day, $year);
	}

	private function easterDate($year, $offset = null)
	{
		// Algorithm:
		// http://code.activestate.com/recipes/576517-calculate-easter-western-given-a-year/

		$a = $year % 19;
		$b = floor($year / 100);
		$c = $year % 100;
		$d = (19 * $a + $b - floor($b / 4) - floor(($b - floor(($b + 8) / 25) + 1) / 3) + 15) % 30;
		$e = (32 + 2 * ($b % 4) + 2 * floor($c / 4) - $d - ($c % 4)) % 7;
		$f = $d + $e - 7 * floor(($a + 11 * $d + 22 * $e) / 451) + 114;
		$month = floor($f / 31);
		$day = $f % 31 + 1;

		$date = $this->getStartDate($day, $month, $year);

		if($offset != null)
			$date = strtotime($offset . ' days', $date);

		return $date;
	}

	private function winterDate($year, $offset, $day)
	{
		$winterDate = $this->getStartDate(21, 10, $year - 1);
		$days = ($offset * 7) + ((7 + 6 - date('N', $winterDate)) % 7) - ((7 + 6 - $day) % 7);
		if ((bool) date('L', strtotime('01.01.' . $year)) && (int) date('N', strtotime('30.12.' . ($year - 1))) == 6) {
			$days += 7;
		}
		$winterDay = strtotime('+' . $days . ' days', $winterDate);
		return $winterDay;
	}

	public function printiCal()
	{
		echo $this->getiCalHeader();
		echo $this->getHolidayEvents();
		echo $this->getiCalFooter();
	}
	
	public function getHolidayEvents()
	{
		$oldDateFormat = $this->_dateFormat;
		$this->_dateFormat = 'Ymd';

		foreach($this->_holidays as $year => $holidays)
		{
			foreach($holidays as $holiday)
			{
				$event = $holiday->getEvent();

				if($holiday->isHoliday())
					$event .= ' [FR�]';

				$output .= "BEGIN:VEVENT\r\n";
				$output .= "DTSTART;VALUE=DATE:" . $this->formatDate($holiday->getStartDate()) . "\r\n";
				$output .= "DTEND;VALUE=DATE:" . $this->formatDate($holiday->getEndDate()) . "\r\n";
				$output .= "DTSTAMP:" . $this->formatDate($holiday->getStartDate()) . "T000000Z\r\n";
				$output .= "SUMMARY:" . $event . "\r\n";
				$output .= "END:VEVENT\r\n";
			}
		}

		$this->_dateFormat = $oldDateFormat;
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
