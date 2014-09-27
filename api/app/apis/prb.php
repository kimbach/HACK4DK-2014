<?php

namespace APIs;

/** Politiets Register Blade **/
class PRB extends API
{

	private static $instance;

	public static function instance()
	{
		if(!self::$instance)
		{
			self::$instance = new PRB("http://www.politietsregisterblade.dk/api/1/?");
		}
		return self::$instance;
	}

	protected function __construct($host)
	{
		parent::__construct($host);
	}

	public function getRoadId($roadName)
	{
		$apiString =
			$this->host . "type=road&name=".
			 urlencode($roadName) . "&limitstart=0&limit=1";
		// echo $apiString, "<br/>";

		return json_decode($this->request($apiString));
	}

	public function getRegisterBlade($roadId, $roadNumber)
	{
		$apiString = $this->host . "type=address&road_id=" .
					    $roadId . "&number=" . $roadNumber;
	    // echo $apiString, "\n";
		$result = json_decode($this->request($apiString));

		if(count($result) > 1)
			array_pop($result);
		return $result;
	}

	public function getRegisterBladeByCoord($lat, $lng)
	{
		$roadJSON = \APIs\AWS::instance()->getRoad($lat, $lng);
		$idJSON = $this->getRoadId($roadJSON->vejnavn->navn);
		$registerbladeJSON = $this->getRegisterBlade($idJSON[0]->id, $roadJSON->husnr);
		return $registerbladeJSON;
	}

	public function getPersonsForRegIds(array $ids)
	{
		$persons = array();
		for($i = 0, $len = count($ids); $i < $len; $i++)
		{
			$ps = $this->getPersonsByRegId($ids[$i]->registerblad_id);
			if(count($ps) > 1)
				array_pop($ps); // pop stupid "result" object
			$persons[] = $ps;
		}
		return $persons;
	}

	/**
	 *
	 * @return An array of array of persons (one array for each registerblad)
	 */
	public function getPersonsByRegId($id)
	{
		$apiString = $this->host . "type=person&registerblad_id=" .
					  urlencode($id);
		return json_decode($this->request($apiString));
	}


	public function getRegisterBladeByDate(array $blade, \DateTime $theDate)
	{
		$result = array();
		foreach ($blade as $b)
		{
			$date = \DateTime::createFromFormat("d-m-Y", trim($b->date));
			if($date->format("d-m-Y") === $theDate->format("d-m-Y"))
				$result[] = $b;
		}

		return $result;
	}


	public function filterRegisterBladeByDates(array $blade, \DateTime $from, \DateTime $to)
	{
		$result = array();
		foreach ($blade as $b)
		{
			$date = \DateTime::createFromFormat("d-m-Y", trim($b->date));
			if($date >= $from && $date <= $to)
				$result[] = $b;
		}

		return $result;
	}

	public function filterRegisterBladeByFloor(array $blade, $floor)
	{
		$result = array();
		foreach ($blade as $b)
		{
			if($b->floor == $floor)
				$result[] = $b;
		}
		return $result;
	}

	public function filterRegisterBladeByLetter(array $blade, $letter)
	{
		$result = array();
		foreach ($blade as $b)
		{
			if($b->letter == $letter)
				$result[] = $b;
		}
		return $result;
	}

	public function filterRegisterBladeBySide(array $blade, $side)
	{
		$result = array();
		foreach ($blade as $b)
		{
			if($b->side == $side)
				$result[] = $b;
		}
		return $result;
	}
}