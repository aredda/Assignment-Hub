<?php
class Date
{
	public $year;
	public $month;
	public $day;

	function __construct($strDate)
	{
		$strDate = explode("-", $strDate);

		$this->day = $strDate[0];
		$this->month = $strDate[1];
		$this->year = $strDate[2];
	}

	public function displayDate()
	{
		return $this->day . "-" . $this->month . "-" . $this->year;
	}

	public function toTime()
	{
		return strtotime($this->displayDate());
	}

	public function move($direction, $step)
	{
		$limit = $direction == 'next' ? cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year) : 1;
		
		$step = ($direction == 'prev' ? -1 : 1) * ($step == 'day' ? 1 : 7);

		$check = $step < 0 ? ($this->day + $step < $limit) : ($this->day + $step > $limit);

		if ($check) 
			throw new Exception("Range exceeded!");

		$newDate = new Date($this->displayDate());
		$newDate->day += $step;

		return $newDate;
	}
}