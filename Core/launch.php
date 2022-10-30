<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

spl_autoload_register(function($class) {
	include $class . ".php";
});
