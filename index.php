<?php
	// header("content-type: application/json");	

	include_once "scripts/oauth.php";
	include_once "scripts/request.php";
	include_once "scripts/utils.php";

	$twit = getTimeLine(CLEAN_TWIT);

	export("twit", $twit);

	include_once "view/main.php";
?>