<?php

function get_fullname(){
	if(is_loggedin()){
		$username = $_COOKIE['username'];
		$query = "SELECT * FROM `auth` WHERE username='$username'";
		$connection = get_db_connection();
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			return $row['full_name'];
		} else {
			return null;
		}
	} else {
		return null;
	}
}

