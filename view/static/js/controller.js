let STATE_BOYER_MOORE = 0;
let STATE_KMP = 1;
let STATE_REGEX = 2;

var state = HTML_ALGORITHM;
var twits = HTML_TWITS;

$(document).ready(function() {
	if (HTML_PAGE == "about") {
		return;
	}
	$("#keywords").val(HTML_KEYWORDS);
	var twitBox = ' \
	<li class="list-group-item"> \
		<div class="row tweet"> \
		    <div id="$status" class="col-md-2 col-sm-12"> \
		        <img width="50px" height="50px" src=$spam> \
		    </div> \
		    <div class="col-md-10 col-sm-12"> \
		        <h6 class="username">$user</h6> \
		        <p id="$idmsg" class="tweet-message">$message</p> \
		    </div> \
		</div> \
	</li>'; 

	twits.forEach((twit, index) => {
		var box = twitBox;

		box = box.replace("$status", "status-"+index);
		box = box.replace("$user", "@"+twit.user);
		box = box.replace("$message", twit.text);
		box = box.replace("$idmsg", "message-"+index);

		if (twit.result != null) {
			if (twit.result.index == -1) {
				box = box.replace("$spam", "res/img/not-spam.png");
			} else {
				box = box.replace("$spam", "res/img/spam.png");
			}
		} else {
			box = box.replace("$spam", "res/img/unknown.png");
		}

		$("#twit-group").append(box);
	});
});

function detectSpam() {
	if (state < STATE_BOYER_MOORE || state > STATE_REGEX) {
		state = STATE_BOYER_MOORE;
	}
	$("#algorithm").val(state);
	$("#query").submit();
}

function changeState(algorithm) {
	if (algorithm == "bm") {
		$("#algorithm").val(STATE_BOYER_MOORE);
	} else if (algorithm == "kmp") {
		$("#algorithm").val(STATE_KMP);
	} else if (algorithm == "regex") {
		$("#algorithm").val(STATE_REGEX);
	} else {
		state = -1;
	}
	$("#query").submit();
}

function goToAbout() {
	$("#about").submit();
}

function goToHome() {
	$("#home").submit();
}