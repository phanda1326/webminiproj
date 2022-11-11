<?php

$db_conn = NULL;
$db_username = 'root';
$db_password = '';
$db_servername = 'localhost';
$db_name = 'webminiproj';

$SALT = 'askhfbauygb23iory7298dhkewhbfq8e7gfy';

function get_db_connection() {
	global $db_conn;
	global $db_servername;
	global $db_username;
	global $db_password;
	global $db_name;

	if($db_conn != NULL){ //check if an existing connection is open
		return $db_conn; //return the existing connection
	} else { //make a new connection
		$db_conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
		if(!$db_conn){
			die("Connection failed: ".mysqli_connect_error());
		} else {
			return $db_conn;
		}
	}
}

function is_loggedin(){
	if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
	  if(!verify_session($_COOKIE['username'], $_COOKIE['token'])){
	    return false;
	  } else {
	  	return true;
	  }
	} else {
	  return false;
	}
}

function do_login($username, $password, $remember){
	$password = get_hashed_password($password);
	$query = "SELECT * FROM auth WHERE username='$username' AND password='$password';";
	$connection = get_db_connection();
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		return add_session($row['username'], $row['password'], $remember, $connection);
	} else {
		return false;
	}
}

function add_session($username, $password, $remember, $db_conn){
	$token = get_hashed_password($password.time());
	$query = "INSERT INTO `sessions` (`username`, `session_token`, `remember`) VALUES ('$username', '$token', $remember);";
	$result = mysqli_query($db_conn, $query);
	if($result){
		$query = "UPDATE `sessions` SET is_valid = '1' WHERE username = '$username' AND session_token = '$token';";
		mysqli_query($db_conn, $query);
		if($remember == '1'){
			setcookie('username', $username, time()+(7*24*60*60)); //remember for 7 days
			setcookie('token', $token, time()+(7*24*60*60));
		} else {
			setcookie('username', $username); //remember for session
			setcookie('token', $token);
		}
		return 1;
	}
}

function verify_session($username, $token){
	$query = "SELECT * FROM `sessions` WHERE username='$username' AND session_token='$token';";
	$connection = get_db_connection();
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		if($row['is_valid'] == 1){
			$time = strtotime($row['created_on']);
			if($row['remember'] == '1'){
				if(time() <= $time+(7*24*60*60)){
					return true;
				} else {
					return false;
				}
			} else {
				if(time() <= $time+(1*24*60*60)){
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
}

function logout($username, $token){
	print_r($username);
	print_r($token);
	$query = "UPDATE `sessions` SET is_valid = '0' WHERE username = '$username' AND session_token = '$token';";
	$db_conn = get_db_connection();
	return mysqli_query($db_conn, $query);
	//die();
}

function do_signup($username, $password, $full_name, $mobile){
	$otp = rand(1000, 9999);
	$password = get_hashed_password($password);
	$query = "INSERT INTO `auth` (`username`, `password`, `full_name`, `mobile_number`, `is_admin`, `otp`) VALUES ('$username', '$password', '$full_name', '$mobile', '0', '$otp');";
	$db_conn = get_db_connection();
	if(mysqli_query($db_conn, $query)) {
		return 1;
	} else {
		return mysqli_error($db_conn);
	}
}

function get_hashed_password($password){
	global $SALT;
	return strrev(md5($password.$SALT));
}

function do_verify_signup($username, $otp){
	$query = "SELECT * FROM `auth` WHERE username='$username';";
	$db_conn = get_db_connection();
	$result = mysqli_query($db_conn, $query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
		// print_r($row);
		// echo var_dump($otp);
		// echo var_dump($row['otp']);
		// die();
		if($otp == $row['otp']){
			return activate($row['id']) ? 1 : -1;
		} else {
			return -1; //invalid otp
		}

		//TODO: OTP EXPIRED CONDITION - Try to compare the database time with current time, and if it exceeds 5 mins, do not validate OTP, generate a new OTP and try to vaidate it.
	} else {
		return 0; //user account not found
	}
}

function activate($id){
	$query = "UPDATE `auth` SET `is_verified` = '1' WHERE (`id` = '$id');";
	$db_conn = get_db_connection();
	return mysqli_query($db_conn, $query);
}

function resent_otp(){
 //Write code to regenerate OTP and update the row.
}