<?php

namespace Core;

use Core\Delete\DeleteData;
use Core\Get\GetData;
use Core\Post\PostData;
use Core\Replace\ReplaceData;

class App
{
	private $uri;
	private $uri_method;
	private $uri_json;
	private $uri_id;

	public function __construct()
	{
		$this->uri = $this->get_uri();
		$this->uri_method = $this->get_method();
		$this->uri_json = $this->get_json_name();
		$this->uri_id = $this->get_id();

		$this->query();
	}

	private function query()
	{
		if ($this->uri_method == "get") {
			$query = new GetData($this->uri_json);
			$query->response_data();
		}

		if ($this->uri_method == "post") {
			$query = new PostData($this->uri_json);
			$query->upload_data();
			$query->response_data();
		}

		if ($this->uri_method == "delete") {
			$query = new DeleteData($this->uri_json, $this->uri_id);
			$query->delete_data();
		}

		if ($this->uri_method == "replace") {
			$query = new ReplaceData($this->uri_json);
			$query->replace_data();
			$query->response_data();
		}
	}

	private function get_uri()
	{
		return explode("/", $_SERVER["REQUEST_URI"]);
	}

	private function get_method()
	{
		if (isset($this->uri[1])) {
			return $this->uri[1];
		}
		return null;
	}

	private function get_json_name()
	{
		if (isset($this->uri[2])) {
			return $this->uri[2];
		}
		return null;
	}

	private function get_id()
	{
		if (isset($this->uri[3])) {
			return $this->uri[3];
		}
		return null;
	}
}
