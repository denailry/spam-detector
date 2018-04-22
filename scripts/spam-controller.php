<?php
	define("BOYER_MOORE", 0);
	define("KMP", 1);
	define("REGEX", 2);

	function searchKeywords($input, $algorithm) {
		file_put_contents("res/input.json", json_encode($input));
		if ($algorithm == BOYER_MOORE) {
			$res = exec('call "bin\\boyer-moore.exe" "res\input.json"', $line, $status);
		} else if ($algorithm == KMP) {
			$res = exec('call "bin\\KMP.exe" "res\input.json"', $line, $status);
		} else if ($algorithm == REGEX) {
			$res = exec('call "bin\\regex.exe" "res\input.json"', $line, $status);
		}
		return array("index" => $res, "status" => $status);
	}
?>