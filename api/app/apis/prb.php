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
		for($i = 0, $len = count($ids) -1; $i < $len; $i++) // Skip last item
		{
			$persons[] = $this->getPersonsByRegId($ids[$i]->registerblad_id);
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


	public function getRegisterBladesByDate(array $blade, \DateTime $theDate)
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
}