<?php
namespace APIs;


class AWS extends API
{

	private static $instance;

	public static function instance()
	{
		if(!self::$instance)
		{
			self::$instance = new AWS("http://webapi.aws.dk/");
		}
		return self::$instance;
	}

	protected function __construct($host)
	{
		parent::__construct($host);
	}

	public function getRoad($lat, $lng)
	{
		$apiString = $this->host . "adresser/" . $lat . "," . $lng . ".json";
		return json_decode($this->request($apiString));
	}
}
