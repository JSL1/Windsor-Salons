<?php
	require_once('connect.php');	
	session_start();
	
	if (!isset($_SESSION['user_id'])) {
		if (isset($_POST['submit'])) {

			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
				$data = mysqli_query($dbc, $query);
				$query = "SELECT user_id, username FROM Users WHERE username = '$user_username' and password = SHA('$user_password')";

			
			if (!empty($user_username) && !empty ($user_password)) {

				
				if (mysqli_num_rows($data) == 1) {
					$row = mysqli_fetch_array($data);
						$_SESSION['user_id']=$row['user_id'];
						$_SESSION['username']=$row['username'];
					$home_url = 'index.php';
					header('Location: ' . $home_url);
				}
				else {
					$error_msg = 'Sorry, you must enter a valid username and password to log in.';
				}
			}
			else {
				$error_msg = 'Sorry, you must enter a username and password to log in.';
			}
		}
	}
?>
