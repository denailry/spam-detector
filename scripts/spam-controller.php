<?php
	define("BOYER_MOORE", 0);
	define("KMP", 1);
	define("REGEX", 2);

	function searchKeywords($input, $algorithm) {
		file_put_contents("../res/input.json", $input);
		if ($algorithm == BOYER_MOORE) {
			$res = exec("bin\boyer-moore.exe");
		} else if ($algorithm == KMP) {
			$res = exec("bin\KMP.exe");
		} else if ($algorithm == REGEX) {
			$res = exec("bin\regex.exe");
		}
		return $res;
	}
?>