<?php
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

	function getTimeLine() {
		$baseUrl = "https://api.twitter.com/1.1/statuses/home_timeline.json";
		$httpMethod = "GET";

		$param["q"] = "new";
		$param["count"] = 20;
		$param["exclude_replies"] = true;
		$param["include_entities"] = false;

		$header = makeOAuthHeader($httpMethod, $baseUrl, $param);

		return sendRequest($baseUrl, $param, $header);
	}
?>