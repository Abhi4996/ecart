<?php
function checkLoggedInOrNot() {
	if (isset($_SESSION["user"])) {
		return true;
	} else {
		return false;
	}
}
?>