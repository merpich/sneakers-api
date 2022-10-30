<?php

namespace Core\Get;

class GetData
{
	private $json_uri;

	public function __construct($json_name)
	{
		$this->json_uri = "Data/{$json_name}.json";
	}

	public function response_data()
	{
		echo $this->get_data();
	}

	private function get_data()
	{
		return file_get_contents($this->json_uri);
	}
}
