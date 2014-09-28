<?php
namespace APIs;

require("app/lib/CIP-PHP-Client/vendor/autoload.php");

class Natmus extends API
{

	private static $instance;

	public static function instance()
	{
		if(!self::$instance)
		{
			self::$instance = new Natmus("http://samlinger.natmus.dk/");

		}
		return self::$instance;
	}

	private $client;

	protected function __construct($host)
	{
		parent::__construct($host);
		$client = new \CIP\CIPClient($host, false);
		$response = $client->system()->getversion();
		print_r($response['version']);
	}

	public function getRoad($lat, $lng)
	{
		$apiString = $this->host . "adresser/" . $lat . "," . $lng . ".json";
		return json_decode($this->request($apiString));
	}
}
