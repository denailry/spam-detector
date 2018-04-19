<?php
	define("URL_ENCODE", 0);
	define("RAW_ENCODE", 1);

	function encodeMap($map, $type) {
		$keys = array_keys($map);
		for ($i = 0; $i < sizeof($keys); $i++) {
			$key = $keys[$i];
			switch ($type) {
				case URL_ENCODE:
					$map[$key] = rawurlencode($map[$key]);
					break;
				case RAW_ENCODE:
					$map[$key] = urlencode($map[$key]);
					break;
			}
		}
		return $map;
	}

	function mapToString($map) {
		$res = array();
		$keys = array_keys($map);
		sort($keys);
		for ($i = 0; $i < sizeof($keys); $i++) {
			$key = $keys[$i];
			array_push($res, $key."=".$map[$key]);
		}
		return $res;
	}

	function bundle($arr, $separator) {
		$res = "";

		$len = sizeof($arr);
		for ($i = 0; $i < $len; $i++) {
			$res = $res.$arr[$i];
			if (($i+1) < $len) {
				$res = $res.$separator;
			}
		}

		return $res;
	}

	function wrap($arr, $wrapper) {
		$keys = array_keys($arr);
		for ($i = 0; $i < sizeof($keys); $i++) {
			$key = $keys[$i];
			$arr[$key] = $wrapper.$arr[$key].$wrapper;
		}
		return $arr;
	}

	function encodeUrl($url, $query) {
		$encoded = encodeMap($query, URL_ENCODE);
		$strMap = mapToString($encoded);
		$res = $url."?".bundle($strMap, "&");
		return $res;
	}
?>