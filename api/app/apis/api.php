<?php
namespace APIs;



class API
{

	protected function __construct($host)
	{
		$this->host = $host;
	}

	public function getHost()
	{
		return $this->host;
	}

	protected function request($uri)
	{
		$req = \Web::instance()->request($uri);
		return $req["body"];
	}
}