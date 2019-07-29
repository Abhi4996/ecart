<?php
include "partials/head.php";
include "partials/header.php";

//error_reporting(E_ALL);
//ini_set("display_errors", "on");
//print_r($_POST);

$firstname = (isset($_POST["firstname"])) ? $_POST["firstname"]  :  "";
$lastname = (isset($_POST["lastname"])) ? $_POST["lastname"]  :  "";
$email = (isset($_POST["email"])) ? $_POST["email"]  :  "";
$phone = (isset($_POST["phone"])) ? $_POST["phone"]  :  "";
$pwd = (isset($_POST["pwd"])) ? $_POST["pwd"]  :  "";

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$phone_error = "";
$pwd_error = "";

if (isset($_POST["register"]) && !empty($_POST["register"])) {
	$is_valid = true;
	
	if (empty($firstname)) {
		$firstname_error = "Please give first name";
		$is_valid = false;
	}

	if (empty($lastname)) {
		$lastname_error = "Please give last name";
		$is_valid = false;
	}

	if (empty($email)) { //Check whether email is blank or not
		$email_error = "Please give email";
		$is_valid = false;
	} else {
		$is_valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!$is_valid_email) {//Check whether email is valid or not
			$email_error = "Invalid email";
			$is_valid = false;
		} else {//Check whether email exists or not.
			$query = "SELECT * FROM user_details WHERE email = '$email' LIMIT 0,1";
			$result = mysqli_query($con, $query);

			/*$row = mysqli_fetch_assoc($result);
			if (!is_null($row)) {
				echo "Email exists";
			}*/

			if ($result->num_rows > 0) {
				$email_error = "Email already exists";
				$is_valid = false;
			}
		}
	}

	if (empty($phone)) {
		$phone_error = "Please give phone number";
		$is_valid = false;
	}
	
	if (empty($pwd)) {
		$pwd_error = "Please give password";
		$is_valid = false;
	}
	
	if ($is_valid) {
		$query = "INSERT INTO user_details (id, first_name, last_name, email, password) VALUES(null, '$firstname', '$lastname', '$email', '$pwd')";
		$result = mysqli_query($con, $query);
		$_SESSION["success_message"] = "You have registered successfully. Please login.";
		header("Location: login.php");
		exit;
		//die();
	} else {
		$_SESSION["error_message"] = "Validation failed";
	}
}

?>

	<section class="main" id="main">

		<?php include "partials/message.php" ?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login-sec form-sec">
						<h2 class="heading">Create Account</h2>
						<form method="post" onsubmit="return isValid()" action="registration.php">
							<div class="row ">
								<div class="col-md-6">
									<div class="form-group <?php if(!empty($firstname_error)) echo "has-error"; ?>">
										<label class="control-label">
											<i class="fa fa-user" aria-hidden="true"></i> First name
										</label>
										<input type="text" class="form-control input-lg" name="firstname" value="<?php echo $firstname; ?>">
										<span class="help-block"><?php echo $firstname_error; ?></span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php if(!empty($lastname_error)) echo "has-error"; ?>">
										<label class="control-label">
											<i class="fa fa-user" aria-hidden="true"></i> Last name:
										</label>
										<input type="text" class="form-control input-lg" name="lastname" value="<?php echo $lastname; ?>">
										<span class="help-block"><?php echo $lastname_error; ?></span>
									</div>
								</div>
							</div>
							<div class="form-group <?php if(!empty($email_error)) echo "has-error"; ?>">
								<label class="control-label">
									<i class="fa fa-envelope" aria-hidden="true"></i> Enter email:
								</label>
								<input type="text" class="form-control input-lg" name="email" value="<?php echo $email; ?>">
								<span class="help-block"><?php echo $email_error; ?></span>
							</div>
							<div class="form-group <?php if(!empty($phone_error)) echo "has-error"; ?>">
								<label class="control-label">
									<i class="fa fa-phone" aria-hidden="true"></i> Phone Number
								</label>
								<input type="tel" class="form-control input-lg" name="phone" value="<?php echo $phone; ?>">
								<span class="help-block"><?php echo $phone_error; ?></span>
							</div>
							<div class="form-group <?php if(!empty($pwd_error)) echo "has-error"; ?>">
								<label class="control-label">
									<i class="fa fa-unlock-alt" aria-hidden="true"></i> Password:
								</label>
								<input type="password" class="form-control input-lg" name="pwd" value="<?php echo $pwd; ?>">
								<span class="help-block"><?php echo $pwd_error; ?></span>
							</div>
							<div class="form-group">
								<input type="submit" class="form-control input-lg" name="register" value="Create Account">
								<!-- <button type="submit" name="register" value="1">Create Account</button> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
	function isValid()
	{
		/*var isValid = true;
		if((document.getElementsByName("firstname")[0].value) == '')
		{
			alert("Kindly enter your First Name!");
			return(isValid = false);
		}
		if((document.getElementsByName("lastname")[0].value) == '')
		{
			alert("Kindly enter your Last Name!");
			return(isValid = false);
		}
		if((document.getElementsByName("email")[0].value) == '')
		{
			alert("Kindly enter your Email!");
			return(isValid = false);
		}
		if((document.getElementsByName("phone")[0].value) == '')
		{
			alert("Kindly enter your Phone Number!");
			return(isValid = false);
		}
		if((document.getElementsByName("pwd")[0].value) == '')
		{
			alert("Kindly enter your password!");
		    return(isValid = false);
		}
		return isValid;*/
		return true;
    }
 
</script>

<?php
include "partials/footer.php";
?>