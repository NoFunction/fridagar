<?php
class Holidays
{
	private $_years;
	private $_holidays;

	public function __construct($years)
	{
		if(!is_array($years))
			$years = array($years);

		$this->_years = $years;
		$this->_holidays = array();

		foreach($years as $year)
		{
			$this->_holidays[$year] = array();

			// Nýársdagur
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(1, 1, $year), 'Nýársdagur'));

			// Þréttándi
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(6, 1, $year), 'Þrettándinn'));

			// Bóndadagur
			array_push($this->_holidays[$year], new Holiday($this->winterDate($year, 13, 4), 'Bóndadagur'));

			// Bolludagur
			$temp = $this->easterDate($year, -(7*7));
			$tempDay = 7 - date('N', $temp) - 1 % 7;
			array_push($this->_holidays[$year], new Holiday(strtotime('-' . $tempDay . ' days', $temp), 'Bolludagur'));

			// Sprengidagur
			array_push($this->_holidays[$year], new Holiday(strtotime('-' . ($tempDay-1) . ' days', $temp), 'Sprengidagur'));

			// Öskudagur
			array_push($this->_holidays[$year], new Holiday(strtotime('-' . ($tempDay-2) . ' days', $temp), 'Öskudagur'));

			// Konudagur
			array_push($this->_holidays[$year], new Holiday($this->winterDate($year, 18, 6), 'Konudagur'));

			// Skírdagur
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, -3), 'Skírdagur'));

			// Föstudagurinn langi
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, -2), 'Föstudagurinn langi'));

			// Páskadagur
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year), 'Páskadagur'));

			// Annar í páskum
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, 1), 'Annar í páskum'));

			// Sumardagurinn fyrsti
			$temp = $this->getStartdate(18, 4, $year);
			$tempDay = (7 - date('N', $temp) + 4) % 7;
			array_push($this->_holidays[$year], new Holiday(strtotime('+' . $tempDay . ' days', $temp), 'Sumardagurinn fyrsti'));

			// Verkalýðsdagurinn
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(1, 5, $year), 'Verkalýðsdagurinn'));

			// Uppstigningardagur
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, 39), 'Uppstigningardagur'));

			// Hvítasunnudagur
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, 49), 'Hvítasunnudagur'));

			// Annar í Hvítasunnu
			array_push($this->_holidays[$year], new Holiday($this->easterDate($year, 50), 'Annar í Hvítasunnu'));

			// Sjómannadagurinn
			$temp = $this->getStartdate(1, 6, $year);
			$tempDay = (7 - date('N', $temp)) % 7;
			array_push($this->_holidays[$year], new Holiday(strtotime('+' . $tempDay . ' days', $temp), 'Sjómannadagurinn'));

			// Þjóðhátíðardagur
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(17, 6, $year), 'Þjóðhátíðardagur'));

			// Frídagur verslunarmanna
			$temp = $this->getStartdate(1, 8, $year);
			$tempDay = (7 - date('N', $temp) + 1) % 7;
			array_push($this->_holidays[$year], new Holiday(strtotime('+' . $tempDay . ' days', $temp), 'Frídagur verslunarmanna'));

			// Verslunarmannahelgi
			$temp = $this->getStartdate(1, 8, $year);
			$tempDay = (7 - date('N', $temp) + 5) % 7;
			array_push($this->_holidays[$year], new Holiday(strtotime('+' . $tempDay . ' days', $temp), 'Verslunarmannahelgi'));

			// Þorláksmessa
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(23, 12, $year), 'Þorláksmessa'));

			// Aðfangadagur
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(24, 12, $year, 13), 'Aðfangadagur'));

			// Jóladagur
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(25, 12, $year), 'Jóladagur'));

			// Annar í Jólum
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(26, 12, $year), 'Annar í Jólum'));

			// Gamlársdagur
			array_push($this->_holidays[$year], new Holiday($this->getStartDate(31, 12, $year, 13), 'Gamlársdagur'));
		}

	}


	public function getHolidays()
	{
		return $this->_holidays;
	}

	private function formatDate($date)
	{
		return date('d.m.Y', $date);
	}

	private function getStartDate($day, $month, $year, $hour = 0)
	{
		return mktime(0, 0, $hour, $month, $day, $year);
	}

	private function easterDate($year, $offset = null)
	{
		// Algorithm: http://code.activestate.com/recipes/576517-calculate-easter-western-given-a-year/
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
};
?>