<!DOCTYPE html>
<html>

<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="signUp.css">
</head>

<body>


<?php


require('db_con.php');
session_start();
$message = "";

	if ($_SERVER["REQUEST_METHOD"] === "POST") {

		// sign up form

		if($_POST['sgn'] === '0'){
			$fn1 = filter_var($_POST['fn'], FILTER_SANITIZE_STRING);
			$eml1 = filter_var($_POST['eml1'], FILTER_SANITIZE_EMAIL);
			$pswd1 = filter_var($_POST['pswd1'], FILTER_SANITIZE_STRING);

			if(empty($fn1) || (!is_string($fn1))){
				$message .= "Full Name can not be empty";
			} else if(empty($eml1) && (!filter_var($eml1, FILTER_VALIDATE_EMAIL))){
				$message .= "Email can not be empty";
			}  else if(empty($pswd1) && (!filter_var($pswd1, FILTER_VALIDATE_STRING))){
				$message .= "Email can not be empty";
			} else {
				$selectForSignUp = "SELECT userid FROM user WHERE eml = ? LIMIT 1";
				$q = mysqli_stmt_init($dbcon);
				mysqli_stmt_prepare($q, $selectForSignUp);
				mysqli_stmt_bind_param($q, 's', $eml1);
				mysqli_stmt_execute($q);
				$result = mysqli_stmt_get_result($q);
				if(mysqli_num_rows($result)===1){
					$message .= "phele s kisi ka hai kuch aur lele";
				} else{
					$hash_pswd = password_hash($pswd1, PASSWORD_DEFAULT);
					$message .= "sahi ha bhai lele";

					$insertToSignUp = "INSERT INTO user(userid, name, ";
					$insertToSignUp .= "eml, pswd, rtime)";
					$insertToSignUp .= "VALUES(' ', ?, ?, ?, NOW())";
					$queryToSignUp = mysqli_stmt_init($dbcon);
					mysqli_stmt_prepare($queryToSignUp, $insertToSignUp);
					mysqli_stmt_bind_param($queryToSignUp, 'sss', $fn1, $eml1, $hash_pswd);
					mysqli_stmt_execute($queryToSignUp);
					if(mysqli_stmt_affected_rows($queryToSignUp) > 0){
					 header("Location: index.php");

						$message .= "<br>hogya bhai siogn up";
						$_SESSION['id'] = mysqli_insert_id($dbcon);
						echo "<br>".$_SESSION['id'];
					} else {
						echo "some error occured";
						mysqli_close($dbcon);
					}
				}
			}
		}
	// sign up form End


	// Log in form
		if($_POST['lgn'] === '1'){

			$eml2 = filter_var($_POST['eml2'], FILTER_SANITIZE_EMAIL);
			$pswd2 = filter_var($_POST['pswd2'], FILTER_SANITIZE_STRING);

			if(empty($eml2) && !filter_var($eml2, FILTER_VALIDATE_EMAIL)){
				$message .= "<br>email is wrong";
			} else if(empty($pswd2) && !filter_var($pswd2, FILTER_VALIDATE_STRING)){
				$message .= "password is wrong";
			} else {
				$selectToLogIn = "SELECT * FROM user WHERE eml = ?";
				$q = mysqli_stmt_init($dbcon);
				mysqli_stmt_prepare($q, $selectToLogIn);
				mysqli_stmt_bind_param($q, 's', $eml2);
				mysqli_stmt_execute($q);
				$resultLogIn = mysqli_stmt_get_result($q);

				if(mysqli_num_rows($resultLogIn) == 1){

					$row = mysqli_fetch_array($resultLogIn, MYSQLI_ASSOC);
					if(password_verify($pswd2, $row['pswd'])){
						$_SESSION['id'] = $row['userid'];
						header("Location: index.php");
					} else {
						echo "wrong";
					}
				} else {
					echo "doest not exist";
				}
			}


		}


	}

	echo $message;

?>


	<!-- =============SECTION-1============= -->
	<section id="section-1">

		<h1>Log In</h1>

		<div id="logInBox">
			<!-- ===========Log In Form ========== -->
			<form id="logInBox" method="post">

				<h4>Email</h4>
				<input type="email" name="eml2" placeholder="Email">

				<h4>Password</h4>
				<input type="password" name="pswd2" placeholder="password">

				<input type="hidden" name="lgn" value="1">

				<input class="lsBtn" type="submit" value="Log In">

			</form>
		</div>

	</section>

	<!-- =============SECTION-1 END============= -->


	<!-- =============SECTION-2 =================-->

	<section id="section-2">

		<h1>Sign Up</h1>

		<div id="signupBox">

			<!-- =============Sign-Up Form============ -->

			<form id="signUpForm" method="post">

				<h4>Full Name</h4>
				<input type="text" name="fn" placeholder="Full Name">

				<h4>Email Id</h4>
				<input type="email" name="eml1" placeholder="email id">

				<h4>Password</h4>
				<input type="password" name="pswd1" placeholder="Password">

				<input id="SfBtn" class="lsBtn" type="submit" name="sbm" value="submit">

				<input type="hidden" name="sgn" value="0">

			</form>

		</div>

	</section>


	<div id="bttmLine">
		<h5><a href="#">Privacy Policy</a> | <a href="#"> Terms and condition</a> | @ Copyright 2021</h5>
	</div>

</body>

</html>
