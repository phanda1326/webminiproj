<?php
include_once 'library/auth.php';

if(isset($_POST['type'])){
	if($_POST['type'] == 'login'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$remember = isset($_POST['remember']) ? $_POST['remember'] : '0';
		if(do_login($username, $password, $remember)){
			header('Location: home.php');
		} else {
			header('Location: index.php?error=1');
		}
	} else if($_POST['type'] == 'signup'){
		$full_name = $_POST['full_name'];
		$mobile = $_POST['mobile'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = do_signup($username, $password, $full_name, $mobile);
		if($result == 1){
			header("Location: verify.php?username=".urlencode($username));
		} else {
			header("Location: signup.php?error=1&error_m=".urlencode($result)."&fn=".urlencode($full_name)."&mob=".urlencode($mobile));
		}
	} else if($_POST['type'] == 'otp'){
		$username = $_POST['username'];
		$otp = $_POST['otp'];
		$r = do_verify_signup($username, $otp);
		if($r == 0){ //no user account found
			header("Location: index.php");
		} else if ($r == -1){ //invalid OTP
			header("Location: verify.php?username=".urlencode($username)."&error=1");
		} else if($r){
			header("Location: index.php?success=1&username=".$_POST['username']);
		}
	}
} else {
	header("Location: index.php");
}