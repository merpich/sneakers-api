<?php

namespace Core\Post;

class PostData
{
	private $json_url;
	private $data;

	public function __construct($json_name)
	{
		$this->json_url = "Data/{$json_name}.json";
		$this->data = json_decode(file_get_contents("php://input"), true);
	}

	public function response_data()
	{
		echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
	}

	public function upload_data()
	{
		$items = $this->get_data();

		if (!empty($this->data)) {
			$id = count($items) + 1;
			$this->data["id"] = $id;
			$items[] = $this->data;
			$json = json_encode($items);
			file_put_contents($this->json_url, $json, JSON_UNESCAPED_UNICODE);
		}
	}

	private function get_data()
	{
		return json_decode(file_get_contents($this->json_url), true);
	}
}
