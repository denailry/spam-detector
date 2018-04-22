<?php
	include_once "scripts/oauth.php";
	include_once "scripts/request.php";
	include_once "scripts/utils.php";
	include_once "scripts/spam-controller.php";

	$twit = getTimeLine(CLEAN_TWIT);
	$req = getQuery(array("keywords", "algorithm"));
	if (notNull($req, array("keywords", "algorithm"))) {
		for ($i = 0; $i < sizeof($twit); $i++) {
			$input = array();
			$input["text"] = $twit[$i]["text"];
			$input["keywords"] = $req["keywords"];
			$twit[$i]["result"] = searchKeywords($input, $req["algorithm"]);
		}
	}
	if (notNull($req, array("keywords"))) {
		export("keywords", $req["keywords"]);
	}
	if (notNull($req, array("algorithm"))) {
		export("algorithm", $req["algorithm"]);
	}

	export("twit", $twit);
?>
<html>
	<head>
		<title>Twitter Spam Detector App</title>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="view/static/css/bootstrap.min.css">
        <link rel="stylesheet" href="view/static/css/style.css">
        <meta >
	</head>
	<body>
		<!-- Content -->
		<?php
			include_once "view/templates/main.html";
		?>

		<!-- Javascript -->
        <!-- Placed at the end of document so the pages load faster -->
        <script type="text/javascript">
        	var HTML_TWITS = <?php getVar("twit") ?>;
        	var HTML_KEYWORDS = <?php getVar("keywords", true) ?>;
        	var HTML_ALGORITHM = <?php getVar("algorithm") ?>;
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
			integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
			crossorigin="anonymous"></script>
        <script type="text/javascript" src="view/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="view/static/js/script.js"></script>
        <script type="text/javascript" src="view/static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="view/static/js/controller.js"></script>
	</body>
</html>