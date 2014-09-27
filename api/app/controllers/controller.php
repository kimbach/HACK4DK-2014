<?php

use APIs\AWS as AWS;
use APIs\PRB as PRB;

class Controller {


	// protected $db;
	protected $f3;

	function __construct(){
		$f3 = \Base::instance();
    	// Connect to the database
		// $db = new \DB\SQL(
		// 	$f3->get("db"),
		// 	$f3->get("admin"),
		// 	$f3->get("pass")
		// );
		// $f3->set("db", $db);
		// $this->db = $db;
		$this->f3 = $f3;
	}

	public function beforeroute($f3)
	{
		$protocol = "http://";

		if($f3->get("PORT") == 443)
			$protocol = "https://";

		$f3->set("PROTOCOL", $protocol);
	}
	public function afterroute($f3){}

	public function home($f3, $params)
	{
		echo "Home!";
	}

	// ---- Routes ---- //

	public function registerblade($f3, $params)
	{
		$get = $f3->get("GET");
		$result = PRB::instance()->getRegisterBladeByCoord($get["lat"], $get["lng"]);

		if(isset($get["from"]) || isset($get["to"]))
		{
			$from = isset($get["from"]) ? new DateTime($get["from"]) : new DateTime(0);
			$to = isset($get["to"]) ? new DateTime($get["to"]) : new DateTime(); // now
			$result = PRB::instance()->filterRegisterBladeByDates($result, $from, $to);
		}
		elseif(isset($get["date"]))
		{
			$result = PRB::instance()->getRegisterBladeByDate($result, new DateTime($get["date"]));
		}

		if(isset($get["floor"]))
		{
			$floor = isset($get["floor"]) ? $get["floor"] : "";
			if(is_numeric($floor) && substr($floor, -1) != ".")
			{
				$floor .= "."; // add . e.g. floor: 3. (for 3rd)
			}

			$result = PRB::instance()->filterRegisterBladeByFloor($result, $floor);
		}
		if(isset($get["letter"]))
		{
			$result = PRB::instance()->filterRegisterBladeByFloor($result, $get["letter"]);
		}
		if(isset($get["side"]))
		{
			$side = $get["side"];
			$last = substr($side, -1);
			if($last != ".") $side .= ".";

			$result = PRB::instance()->filterRegisterBladeBySide($result, $side);
		}



		$this->output($result);
	}

	public function persons($f3, $params)
	{
		// Simply replace persons registerblade with w
		$uri = $f3->get("URI");
		$uri = str_replace("persons?", "registerblade?", $uri);
		$url = $f3->get("PROTOCOL") . $f3->get("HOST") . $uri;
		$req = Web::instance()->request($url);
		$resp = json_decode($req["body"]);
		// echo json_encode($resp);
		$persons = PRB::instance()->getPersonsForRegIds($resp);
		$this->output($persons);

	}


	// ---- Utils ----- //







	protected function output($out)
	{
		header('Content-Type: application/json');
		echo json_encode($out);
	}



}
