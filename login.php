<?php

include "partials/head.php";
include "partials/header.php";

error_reporting(E_ALL);
ini_set("display_errors", "on");

$email = (isset($_POST["email"])) ? $_POST["email"] : "";
$pwd = (isset($_POST["pwd"])) ? $_POST["pwd"] : "";

$email_error = '';
$pwd_error = '';

if (isset($_POST["login"]) && !empty($_POST["login"])) {
	$is_valid = true;
	if (empty($email)) { //Check whether email is blank or not
		$email_error = "Please enter email";
		$is_valid = false;
	} else {
		$is_valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!$is_valid_email) {//Check whether email is valid or not
			$email_error = "Invalid email";
			$is_valid = false;
		} else {//Check whether email exists or not.
			$query = "SELECT * FROM user_details WHERE email = '$email' LIMIT 0,1";
			$result = mysqli_query($con, $query);

			if ($result->num_rows == 0) {
				$email_error = "Email does not exists";
				$is_valid = false;
			}
		}
	}

	if (empty($pwd)) {
		$pwd_error = "Please enter password";
		$is_valid = false;
	}

	if ($is_valid) {//Check email and password is associated for the account
		$query = "SELECT * FROM user_details WHERE email = '$email' AND password = '$pwd' LIMIT 0,1";
		$result = mysqli_query($con, $query);

		if ($result->num_rows > 0) { //query success then set user session and redirect with success message
			$row = mysqli_fetch_assoc($result);
			//Set user session
			$_SESSION["user"] = $row;

			//Set success session messege
			$_SESSION["success_message"] = "Logged in successfully";

			//Set header for redirect
			header("Location: profile.php");
			exit;
			
		} else {
			$_SESSION["error_message"] = "Email or password doesn't match";
		}
	}

}

/*if($isValid) {
	header("Location: profile.php");
}
else {
	SESS
}*/

?>

	<section class="main" id="main">
		
		<?php include "partials/message.php"; ?>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login-sec form-sec">
						<h2 class="heading">Login</h2>
						<form method="post" onsubmit="return isValid()" id="loginDetails" action="login.php">
							<div class="form-group <?php if(!empty($email_error)) echo "has-error"; ?>">
								<label><i class="fa fa-user" aria-hidden="true"></i> Username:</label>
								<input type="text" class="form-control input-lg" id="email" name="email" value="<?php echo $email; ?>">
								<span class="help-block"><?php echo $email_error; ?></span>
							</div>
							<div class="form-group <?php if(!empty($email_error)) echo "has-error"; ?>">
								<label><i class="fa fa-unlock-alt" aria-hidden="true"></i> Password:</label>
								<input type="password" class="form-control input-lg" name="pwd" id="pwd" value="<?php echo $pwd; ?>">
								<span class="help-block"><?php echo $pwd_error; ?></span>
							</div>
							<p>
								<input type="submit" name="login" value="Login" id="loginSubmitBtn">
							</p>
							<p class="login-link clearfix">
								<a href="forget-password.php" class="pull-left">Forget Password?</a> 
								<a href="registration.php" class="pull-right">New user? Register</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

<script type="text/javascript">
	$(document).ready(function() {

		$("body").on("click", "#loginSubmitBtn", loginSubmitBtnClickHandler);
	});

	function loginSubmitBtnClickHandler(event) {

		var isValid = true;
		var $email = $("#email");
		$(".form-group").removeClass("has-error");
		if ($email.val() === "") {
			$email.parents(".form-group").addClass("has-error");
			$email.siblings(".help-block").text("Email cannot be blank.");
			isValid = false;
		}
		var $pwd = $("#pwd");
		if ($pwd.val() === "") {
			$pwd.parents(".form-group").addClass("has-error");
			$pwd.siblings(".help-block").text("Password cannot be blank.");
			isValid = false;
		}

		if (isValid) {
			$("#loginDetails").submit();
		}
	}

 
</script>

<?php
include "partials/footer.php";
?>