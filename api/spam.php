<?php
	include_once "scripts/spam-controller.php";
	include_once "scripts/request.php";
	include_once "scripts/utils.php";

	$req = getQuery(array("keywords", "algorithm", "text"));
	if (notNull($req, array("keywords", "algorithm"))) {
		$keywords = split($req, ",");
		$input = array();
		$input["keywords"] = $keywords;
		$input["text"] = $text;
		$result = searchKeywords($input, $req["algorithm"]);
	} else {
		$result = null;
	}
	echo json_encode($result);
?>