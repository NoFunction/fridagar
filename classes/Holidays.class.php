<?php
date_default_timezone_set('Europe/London');
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

			// Nýársdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(1, 1, $year),
					'Nýársdagur',
					true
				)
			);

			// Þréttándi
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(6, 1, $year),
					'Þrettándinn'
				)
			);

			// Bóndadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->winterDate($year, 13, 4),
					'Bóndadagur'
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

			// Öskudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('-' . ($tempDay-2) . ' days', $temp),
					'Öskudagur'
				)
			);

			// Konudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->winterDate($year, 18, 6),
					'Konudagur'
				)
			);

			// Skírdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, -3),
					'Skírdagur',
					true
				)
			);

			// Föstudagurinn langi
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, -2),
					'Föstudagurinn langi',
					true
				)
			);

			// Páskadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year),
					'Páskadagur',
					true
				)
			);

			// Annar í páskum
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 1),
					'Annar í páskum',
					true
				)
			);

			// Sumardagurinn fyrsti
			$temp = $this->getStartdate(18, 4, $year);
			$tempDay = (7 - date('N', $temp) + 4) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Sumardagurinn fyrsti',
					true
				)
			);

			// Verkalýðsdagurinn
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(1, 5, $year),
					'Verkalýðsdagurinn',
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

			// Hvítasunnudagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 49),
					'Hvítasunnudagur',
					true
				)
			);

			// Annar í Hvítasunnu
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->easterDate($year, 50),
					'Annar í Hvítasunnu',
					true
				)
			);

			// Sjómannadagurinn
			$temp = $this->getStartdate(1, 6, $year);
			$tempDay = (7 - date('N', $temp)) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Sjómannadagurinn'
				)
			);

			// Þjóðhátíðardagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(17, 6, $year),
					'Þjóðhátíðardagur',
					true
				)
			);

			// Frídagur verslunarmanna
			$temp = $this->getStartdate(1, 8, $year);
			$tempDay = (7 - date('N', $temp) + 1) % 7;
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					strtotime('+' . $tempDay . ' days', $temp),
					'Frídagur verslunarmanna',
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

			// Þorláksmessa
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(23, 12, $year),
					'Þorláksmessa'
				)
			);

			// Aðfangadagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(24, 12, $year, 13),
					'Aðfangadagur',
					true
				)
			);

			// Jóladagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(25, 12, $year),
					'Jóladagur',
					true
				)
			);

			// Annar í Jólum
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(26, 12, $year),
					'Annar í Jólum',
					true
				)
			);

			// Gamlársdagur
			array_push(
				$this->_holidays[$year],
				new HolidayEvent(
					$this->getStartDate(31, 12, $year, 13),
					'Gamlársdagur',
					true
				)
			);
		}
	}

	public function getHolidays()
	{
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
				echo $holiday->getEvent() . ' = ' . $this->formatDate($holiday->getStartDate()) . ($holiday->isHoliday() ? ' (frídagur)' : '');

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
		return mktime(0, 0, $hour, $month, $day, $year);
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
		$days = $offset * 7;
		$winterDate = $this->getStartDate(21, 10, $year - 1);
		$winterDay = ((7 - date('N', $winterDate) + 1) + $day) % 7;
		$winterDay = strtotime('+' . ($days + $winterDay) . ' days', $winterDate);

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
					$event .= ' [FRÍ]';

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
