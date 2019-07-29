<?php
include "partials/head.php";
include "partials/header.php";

error_reporting(E_ALL);
ini_set("display_errors", "on");

function checkLoggedIn() {
	if (!isset($_SESSION["user"])) {
		header("Location: login.php");
	}
}
checkLoggedIn();
$user_id=$_SESSION['user']['id'];
$firstname = (isset($_POST["firstname"])) ? $_POST["firstname"]  :  $_SESSION['user']['first_name'];
$lastname = (isset($_POST["lastname"])) ? $_POST["lastname"]  :  $_SESSION['user']['last_name'];
$email = (isset($_POST["email"])) ? $_POST["email"]  :  $_SESSION['user']['email'];
$pwd = (isset($_POST["pwd"])) ? $_POST["pwd"]  :  "";
$con_pwd = (isset($_POST["con_pwd"])) ? $_POST["con_pwd"]  :  "";

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$pwd_error = "";
$con_pwd_error = "";

if (isset($_POST["update"]) && !empty($_POST["update"])) {
    $is_valid = true;
    if (empty($firstname)) {
        $firstname_error = "Please give first name";
        $is_valid = false;
    }
    if (empty($lastname)) {
        $lastname_error = "Please give last name";
        $is_valid = false;
    }
    if (empty($pwd)) {
        $pwd_error = "Please give password";
        $is_valid = false;
    }
    if (empty($con_pwd)) {
        $con_pwd_error = "Please give password";
        $is_valid = false;
    }
    if (empty($email)) { 
        $email_error = "Please give email";
        $is_valid = false;
    } 
    else 
    {
        $is_valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$is_valid_email) 
        {
            $email_error = "Invalid email";
            $is_valid = false;
        } 
        else 
        {
            $query = "SELECT * FROM user_details WHERE email = '$email' LIMIT 0,1";
            $result = mysqli_query($con, $query);

            if ($result->num_rows > 0) {
                $email_error = "Email already exists";
                $is_valid = false;
            }
        }
    }

    if ($is_valid) {
    	
		$query = "UPDATE user_details SET first_name = '$firstname', last_name = '$lastname', email = '$email', password = '$pwd' WHERE id = $user_id ";
		mysqli_query($con, $query);
		$_SESSION['user']['first_name'] = $firstname;
		$_SESSION['user']['last_name'] = $lastname;
		$_SESSION['user']['email'] = $email;
		$_SESSION["success_message"] = "Profile successfully updated.";
	} else {
		$_SESSION["error_message"] = "Validation failed";
	}
}

?>

<section class="main" id="main">
	<?php include "partials/message.php" ?>
		
		<div class="cms-block">			
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="cms-sec profile-sec">
							<div class="row">
								<div class="col-md-4">
									<div class="profile-image"><img src="assets/images/user.png" alt="no img"></div>
								</div>
								<div class="col-md-8">
									<div class="profile-details">
										<h2>User profile</h2>
										<div class="user-details">
											<?php 
												echo '<h3>';
												print_r($_SESSION["user"]["first_name"] . ' ' . $_SESSION["user"]["last_name"]);
												echo '</h3>';
												echo '<div class="email-address">';
												print_r($_SESSION["user"]["email"]);
												echo '</div>';
										?>
											<form id="profilePic">
												<label>Upload Profile Picture: </label>
												<input type="file" name="">
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">																	
									<div class="profile-edit">
										<h2>Profile Edit</h2>
										<div class="user-edit">
											<form class="form-horizontal" method="post" action="profile.php" id="profileDetails">
											  <div class="form-group <?php if(!empty($firstname_error)) echo "has-error"; ?>">
												<label class="col-sm-3 control-label">First Name</label>
												<div class="col-sm-6">

												  <input type="text" name="firstname" class="form-control input-lg" placeholder="Firstname" value="<?php echo $firstname;?>" id="firstname">
												  <span class="help-block"><?php echo $firstname_error; ?></span>
												</div>
											  </div>
											  <div class="form-group <?php if(!empty($lastname_error)) echo "has-error"; ?>">
												<label class="col-sm-3 control-label">Last Name</label>
												<div class="col-sm-6">
												  <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Lastname" value="<?php echo $lastname;?>">
												  <span class="help-block"><?php echo $lastname_error; ?></span>
												</div>
											  </div>
											  <div class="form-group <?php if(!empty($email_error)) echo "has-error"; ?>">
												<label class="col-sm-3 control-label">Email</label>
												<div class="col-sm-6">
												  <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Email" value="<?php echo $email;?>">
												  <span class="help-block"><?php echo $email_error; ?></span>
												</div>
											  </div>
											  <div class="form-group <?php if(!empty($pwd_error)) echo "has-error"; ?>">
												<label class="col-sm-3 control-label">Change Password</label>
												<div class="col-sm-6">
												  <input type="password" name="pwd" id="pwd" class="form-control input-lg" placeholder="Change Password" value="<?php echo  $pwd;?>">
												  <span class="help-block"><?php echo $pwd_error; ?></span>
												</div>
											  </div>
											  <div class="form-group <?php if(!empty($con_pwd_error)) echo "has-error"; ?>">
												<label class="col-sm-3 control-label">Confirm Password</label>
												<div class="col-sm-6">
												  <input type="password" name="con_pwd" id="con_pwd" class="form-control input-lg" placeholder="Confirm Password" value="<?php echo $con_pwd;?>">
												  <span class="help-block"><?php echo $con_pwd_error; ?></span>
												</div>
											  </div>
											  <div class="form-group">
												<div class="col-sm-12">
												  <!-- <input type="submit" value="Update Profile" name="update" class="button1"> -->
												  <!-- <button type="submit" name="update">Update Profile</button> -->
												</div>
											  </div>
											  <p>
											  	<input type="submit" value="Update Profile" name="update" class="button1" id="profileSubmitBtn">
											  </p>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>


<script type="text/javascript">
	$(document).ready(function() {
		//$("#profileSubmitBtn").click(function_name);

		//$("#profileSubmitBtn").on("click", function_name);

		//$("#profileSubmitBtn").unbind("click");
		//$("#profileSubmitBtn").bind("click", function_name);

		$("body").on("click", "#profileSubmitBtn", profileSubmitBtnClickHandler);
	});

	function profileSubmitBtnClickHandler(event) {
		event.preventDefault();

		var isValid = true;
		var $firstname = $("#firstname");

		$(".form-group").removeClass("has-error");
		if ($firstname.val() === "") {
			$firstname.parents(".form-group").addClass("has-error");
			//$firstname.parents(".form-group").find(".help-block").text("Firstname cannot be blank.");
			$firstname.siblings(".help-block").text("Firstname cannot be blank.");
			isValid = false;
		}
		var $lastname = $("#lastname");
		if ($lastname.val() === "") {
			$lastname.parents(".form-group").addClass("has-error");
			$lastname.siblings(".help-block").text("Lastname cannot be blank.");
			isValid = false;
		}
		var $email = $("#email");
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
		var $con_pwd = $("#con_pwd");
		if ($con_pwd.val() === "") {
			$con_pwd.parents(".form-group").addClass("has-error");
			$con_pwd.siblings(".help-block").text("Password and Confirm Password should match.");
			isValid = false;
		}

		if (isValid) {
			$("#profileDetails").submit();
		}
	}

</script>


<?php
include "partials/footer.php";
?>