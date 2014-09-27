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

	public function beforeroute($f3){}
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
		if(isset($get["date"]))
		{
			$result = PRB::instance()->getRegisterBladesByDate($result, new DateTime($get["date"]));
		}

		$this->output($result);
	}

	public function persons($f3, $params)
	{
		$get = $f3->get("GET");
		$rb = PRB::instance()->getRegisterBladeByCoord($get["lat"], $get["lng"]);

		$persons = PRB::instance()->getPersonsForRegIds($rb);
		$this->output($persons);
	}


	// ---- Utils ----- //







	protected function output($out)
	{
		header('Content-Type: application/json');
		echo json_encode($out);
	}



}
