<?php

namespace Core\Delete;

class DeleteData
{
	private $json_url;
	private $id;

	public function __construct($json_name, $id)
	{
		$this->json_url = "Data/{$json_name}.json";
		$this->id = $id;
	}

	public function delete_data()
	{
		$items = json_decode($this->get_data(), true);
		$updated_items = [];
		$deleted_item = [];

		foreach ($items as $item) {
			if ($item["product_id"] != $this->id) {
				$updated_items[] = $item;
			}

			if ($item["product_id"] == $this->id) {
				$deleted_item = $item;
			}
		}

		$json = json_encode($updated_items);
		file_put_contents($this->json_url, $json, JSON_UNESCAPED_UNICODE);
		echo json_encode($deleted_item);
	}

	private function get_data()
	{
		return file_get_contents($this->json_url);
	}
}
