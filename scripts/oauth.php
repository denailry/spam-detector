<?php
	$CONFIG = array();
	$SECRET = array();

	function init() {
		global $CONFIG, $SECRET;

		$CONFIG = json_decode(file_get_contents("config.json"), TRUE);
		$SECRET = array($CONFIG["oauth_consumer_secret"], $CONFIG["oauth_token_secret"]);
		unset($CONFIG["oauth_consumer_secret"]);
		unset($CONFIG["oauth_token_secret"]);
	}

	function makeOAuthHeader($httpMethod, $baseUrl, $param) {
		global $CONFIG, $SECRET;

		$config = $CONFIG;
		$config["oauth_timestamp"] = date_timestamp_get(date_create());
		$signatureParam = bundle(mapToString(encodeMap(array_merge($config, $param), RAW_ENCODE)), "&");
		$signatureBase = bundle(array(strtoupper($httpMethod),  
			rawurlencode($baseUrl), rawurlencode($signatureParam)), "&");
		$signatureKey = bundle($SECRET, "&");
		$signature = rawurlencode(base64_encode(hash_hmac("sha1", $signatureBase, $signatureKey, true)));

		$config["oauth_signature"] = $signature;
		$config = wrap($config, '"');

		$header = array();
		$header[] = "Authorization: "."OAuth ".bundle(mapToString($config), ",");

		return $header;
	}

	init();
?>