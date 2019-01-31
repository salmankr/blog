<?php
session_start();
include "connection.php";
$postID = $_POST['postID'];
if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
	$que = "SELECT * FROM signup WHERE email = '$email'";
	$runQue = mysqli_query($conn, $que);
	while ($rowQue = mysqli_fetch_array($runQue)) {
		$userID = $rowQue['id'];
	}
	$que2 = "SELECT * FROM user_likes WHERE post_id = '$postID' AND user_id = '$userID'";
	$runQue2 = mysqli_query($conn, $que2);
	$countQue2 = mysqli_num_rows($runQue2);
	if ($countQue2 > 0) {
		$query = "UPDATE user_likes SET like_status = '1' WHERE post_id = '$postID' AND user_id = '$userID'";
		$run = mysqli_query($conn, $query);
		if ($run) {
			$q1 = "SELECT * FROM post_likes WHERE post_id = $postID";
			$r1 = mysqli_query($conn, $q1);
			while ($rowq1 = mysqli_fetch_array($r1)) {
				$likes = $rowq1['likes'];
			}
			$likes = $likes + 1;
			$q2 = "UPDATE post_likes SET likes = '$likes' WHERE post_id = '$postID'";
			$r2 = mysqli_query($conn, $q2);
			if ($r2) {
			 	echo 'liked' ;
			 } 
		}
		// while ($rowQue2 = mysqli_fetch_array($runQue2)) {
		// 	$likeStatus = $rowQue2['like_status'];
		// }
		// if ($likeStatus != true) {
		// 	$query = "UPDATE user_likes SET like_status = '1' WHERE post_id = '$postID' AND user_id = '$userID'";
		// 	$run = mysqli_query($conn, $query);
		// 	echo 'like';
		// }else{
		// 	$query = "UPDATE user_likes SET like_status = '0' WHERE post_id = '$postID' AND user_id = '$userID'";
		// 	$run = mysqli_query($conn, $query);
		// 	echo 'unlike';
		// }
	}else{
		$query = "INSERT INTO user_likes (post_id, user_id, like_status) VALUES ('$postID', '$userID', '1')";
		$run = mysqli_query($conn, $query);
		if ($run) {
			$q1 = "SELECT * FROM post_likes WHERE post_id = $postID";
			$r1 = mysqli_query($conn, $q1);
			while ($rowq1 = mysqli_fetch_array($r1)) {
				$likes = $rowq1['likes'];
			}
			$likes = $likes + 1;
			$q2 = "UPDATE post_likes SET likes = '$likes' WHERE post_id = '$postID'";
			$r2 = mysqli_query($conn, $q2);
			if ($r2) {
			 	echo 'liked' ;
			 } 
		}
	}
}
?>