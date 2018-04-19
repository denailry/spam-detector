<?php
	header('Content-Type: application/json');

	include_once "scripts/oauth.php";
	include_once "scripts/utils.php";
	include_once "scripts/request.php";

	echo json_encode(json_decode(getTimeLine()), JSON_PRETTY_PRINT);
?>