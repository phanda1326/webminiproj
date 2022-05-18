<?php

include 'library/auth.php';
include 'library/posts.php';

// if(do_login('sibi', 'password')){
// 	echo "Success";
// } else {
// 	echo "Failed";
// }

$conn = get_db_connection();
$query = "SELECT * FROM lahtp_3_web.auth WHERE username='sibidharan'; -- ' AND password='bce9312a5c3c138853959d490d042ec9';";
$result = mysqli_query($conn, $query);
if(!$result){
	echo("Error: ".mysqli_error($conn));
} else {
	print_r(mysqli_fetch_assoc($result));
}