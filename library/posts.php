<?php

require_once 'auth.php';

/*
1. do_post($body, $image, $username) - return post ID
2. delete_post($id)
3. like_post($id, $username)
4. get_all_posts()
5. get_like_count($post_id)
6. has_liked($post_id)
*/


function do_post($body, $image, $username){
	$query = "INSERT INTO `posts` (`username`, `body`, `image`) VALUES ('$username', '$body', '$image');";
	$conn = get_db_connection();
	if(mysqli_query($conn, $query)){
		$post_id = mysqli_insert_id($conn);
		return $post_id;
	} else {
		return NULL;
	}
}

function get_all_posts(){
	$query = "SELECT * FROM `posts` ORDER BY `id` DESC;";
	$conn = get_db_connection();
	$username = $_COOKIE['username']; //vuln

	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0){
		$posts = [];
		while($row = mysqli_fetch_assoc($result)){
			$posts[] = $row;
		}
		return $posts;
	} else {
		return [];
	}
}

function get_user_posts($username){
	$query = "SELECT * FROM `posts` WHERE `username` = '$username';";
	$conn = get_db_connection();
	$username = $_COOKIE['username']; //vuln

	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0){
		$posts = [];
		while($row = mysqli_fetch_assoc($result)){
			$posts[] = $row;
		}
		return $posts;
	} else {
		return [];
	}
}

if(array_key_exists('delete', $_POST))
	delete_post();

function delete_post(){
	$image = $_POST['delete'];
	$query = "DELETE FROM `posts` WHERE `image` = '$image';";
	$conn = get_db_connection();
	if(mysqli_query($conn, $query))
		header("Location: ../home.php");
	else
		die(mysqli_error($conn));
}