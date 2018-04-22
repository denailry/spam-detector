<?php
	define("CLEAN_TWIT", 0);
	define("ALL_TWIT", 1);

	function sendRequest($baseUrl, $param, $header=NULL) {
		$request = curl_init(); 
		curl_setopt($request,CURLOPT_URL,encodeUrl($baseUrl, $param));
		if ($header != NULL) {
			curl_setopt($request,CURLOPT_HTTPHEADER,$header);
		}
		curl_setopt($request,CURLOPT_RETURNTRANSFER,TRUE); 

		// Header Debugging Codes
		// curl_setopt($request,CURLINFO_HEADER_OUT,TRUE);
		// curl_setopt($request,CURLOPT_HEADER,TRUE);

		$result = curl_exec($request);

		curl_close($request);
		
		return $result;
	}

	function getQuery($arrKeys) {
		$res = array();
		for ($i = 0; $i < sizeof($arrKeys); $i++) {
			$key = $arrKeys[$i];
			if (isset($_GET[$key])) {
				$res[$key] = $_GET[$key];
			} else {
				$res[$key] = null;
			}
		}
		return $res;
	}

	function getTimeLine($param=ALL_TWIT) {
		$baseUrl = "https://api.twitter.com/1.1/statuses/home_timeline.json";
		$httpMethod = "GET";

		$param = array();
		$param["q"] = "new";
		$param["count"] = 20;
		$param["exclude_replies"] = true;
		$param["include_entities"] = false;

		$header = makeOAuthHeader($httpMethod, $baseUrl, $param);

		$response = array();
		$response = json_decode(sendRequest($baseUrl, $param, $header), true);
		if ($param == ALL_TWIT) {
			return $response;
		} else {
			$res = array();
			for ($i = 0; $i < sizeof($response); $i++) {
				$res[$i] = array(
					"text" => $response[$i]["text"],
					"user" => $response[$i]["user"]["screen_name"]
				);
			}
			return $res;
		}
	}
?>