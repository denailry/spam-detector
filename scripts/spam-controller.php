<?php
	define("BOYER_MOORE", 0);
	define("KMP", 1);
	define("REGEX", 2);

	function searchKeywords($input, $algorithm) {
		$inputPath = 'res\in\input.json';
		$wrappedInputPath = '"'.$inputPath.'"';
		file_put_contents($inputPath, json_encode($input));
		if ($algorithm == BOYER_MOORE) {
			$res = exec('call "bin\\boyer-moore.exe" '.$wrappedInputPath, $line, $status);
		} else if ($algorithm == KMP) {
			$res = exec('call "bin\\KMP.exe" '.$wrappedInputPath, $line, $status);
		} else if ($algorithm == REGEX) {
			$res = exec('call "bin\\regex.exe" '. $wrappedInputPath, $line, $status);
		}
		return array("index" => $res, "status" => $status);
	}
?>