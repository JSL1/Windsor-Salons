<?php 
session_start();
require_once("./connectvars.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<META CHARSET="UTF-8">
	<title>Windsor Salon Search Engine Reviews Find Coupons Deals </title>
	<link rel="stylesheet" type="text/css" href="windsorSalons.css" />
</head> 
<body>
<div id='container'>
<header id="hair"></header>
<div id ="loggedin">
	<p>
		<?php 
		if (!isset($_SESSION['Username'])) {
			echo 'You are not logged in. - ';
		} else {
			echo 'You are logged in as <b>' . $_SESSION['Username'] . '</b> - <a href="logout.php"><u>Log Out</u></a> - ';
		}
		?>
		<?php 
		if (!isset($_SESSION['Username'])) { 
			echo '<a href="index.php?u=login"><u>Log In</u></a> - ';
			echo '<a href="index.php?u=signup"><u>Sign up</u></a> - ';
			echo '<a href="http://windsorsalons.com/forum/fluxbb-1.5.6/index.php"><u>Forums</u></a>';
		} else {
			echo '<a href="myaccount.php"><u>My Profile</u></a> - ';
			echo '<a href="http://windsorsalons.com/forum/fluxbb-1.5.6/index.php"><u>Forums</u></a>';
		}
		?>
	</p>
	<!--<button onclick='alert(document.cookie)'>view cookie</button>-->
</div>
<?php 
if (!isset($_SESSION['Username'])) {
	echo '<p class="userinfo">You are not logged in. - </p>';
} else {
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$user_username = $_SESSION['Username'];
	$query = "SELECT user_id, Username, Email, Company, Description FROM Users WHERE Username = '$user_username'";
	$data = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($data);
	
	if (mysqli_num_rows($data) == 1) {
		$user_company = $row['Company'];
		$user_email = $row['Email'];
		$user_description = $row['Description'];
	} else {
		$user_description = "There was a problem retreiving your information";
	}
	?>
	<table class="userinfo">
		<tr>
			<?php
			echo "<td><b><h2>" . $_SESSION['Username'] . "</h2></b></td>";
			?>
		</tr>
		<tr>
			<?php
			echo "<td><b>Email:</b></td><td>" . $row['Email'] . "</td>";
			?>
		</tr>
		<tr>
			<?php
			echo "<td><b>Company: </b></td><td>" . $row['Company'] . "</td>";
			?>
		</tr>
		<tr>
			<?php 
			echo "<td><b>About me: </b></td><td>" . $row['Description'] . "</td>";
			?>
		</tr>
	</table>
	<br />
<?php
	mysqli_close($dbc);
}
?>

<div id="footer">
	<a href="index.php"><img src="./img/logo.png" alt="Hair" id="logo" /></a>
</div>
</body>
</html>
