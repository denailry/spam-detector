<?php
	define("URL_ENCODE", 0);
	define("RAW_ENCODE", 1);

	$EXPORT = array();

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

	function mapToString($map, $mapper="=") {
		$res = array();
		$keys = array_keys($map);
		sort($keys);
		for ($i = 0; $i < sizeof($keys); $i++) {
			$key = $keys[$i];
			array_push($res, $key.$mapper.$map[$key]);
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

	function split($string, $splitter) {
		$res = array();
		$temp = "";
		$i = 0;
		$resCounter = 0;
		$split = false;
		do {
			$j = 0;
			$split = false;
			while ($j < strlen($splitter) && $splitter[$j] == $string[$i + $j]) {
				$j++;
			}
			if ($j == strlen($splitter)) {
				$split = true;
				$i = $i + $j - 1;
			}
			if ($split) {
				$res[$resCounter] = $temp;
				$temp = ""; 
				$resCounter++;
			} else if (($i + 1) == strlen($string)) {
				$temp = $temp.$string[$i];
				$res[$resCounter] = $temp;
			} else {
				$temp = $temp.$string[$i];
			}
			$i++;
		} while ($i < strlen($string));
		return $res;
	}

	/*
	 * Use this to get value of PHP variable 
	 * from html or js code 
	 */
	function getVar($var, $wrap=false) {
		global $EXPORT;
		if (gettype($EXPORT[$var]) == "array") {
			echo json_encode($EXPORT[$var]);
		} else if (gettype($EXPORT[$var]) == "string") {
			if ($wrap) {
				echo wrap($EXPORT[$var], '"');
			} else {
				echo $EXPORT[$var]; 
			}
		} else {
			echo $EXPORT[$var];
		}
	}

	/*
	 * Use this to set value of PHP variable 
	 * to be used in html or js code 
	 */
	function export($var, $value) {
		global $EXPORT;
		$EXPORT[$var] = $value;
	}
?>