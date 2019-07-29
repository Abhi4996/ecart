<?php
if (isset($_SESSION["success_message"])) {
	echo '<div class="alert alert-success alert-customized alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			' . $_SESSION["success_message"] . '
		</div>';
	unset($_SESSION["success_message"]);
}

if (isset($_SESSION["error_message"])) {
	echo '<div class="alert alert-danger alert-customized alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			' . $_SESSION["error_message"] . '
		</div>';
	unset($_SESSION["error_message"]);
}

?>