<!DOCTYPE HTML>
<html>
<head>
	<META CHARSET="UTF-8">
	<title>Windsor Salon Search Engine Reviews Find Coupons Deals </title>
	<link rel="stylesheet" type="text/css" href="windsorSalons.css" />
	<script type="text/javascript">
	function clear() {
		var sB = document.getElementById("searchterm").Value;
		if (sB == "Search local salons...") {
			sB = "";
			}
		}
	</script>
</head> 
<body>
<header id="hair"></header>
	<div id ="loggedin">
		<p>
			<i>You are logged in as: <b><?php echo $loggedInUser ?></b></i>
		</p>
	</div>

<!--

  This grabs the requested page from a text file
  
-->

	<?php/*
	if (isset($_GET['u'])) {
		$ui = $_GET['u'];
	} else {
		$ui = "search";
	}
	if (strpos($ui, "/") !== false) {
		echo "";
	} else if (!$ui) {
		echo "You're looking for a page that doesn't exist!";
	} else {
		echo (file_get_contents($ui . ".txt"));
	}*/
	?>
		<div id="search">
		<form action="search.php"  method="post">
			<input type="text" name="searcht" /><br /><br />
			<input type="submit" name="submit" value='submit' />
		</form>
	</div>
	<div id="Llinks">
	<a href="index.php"><img src="./img/logo.png" alt="Hair" id="logo" /></a>
	<i>Professionals:</i><br />
		<i><a href="index.php?u=login">Log In</a><br />
		<a href="index.php?u=signup">Sign up</a><br />
		<a href="../forum/">Forum</a></i>

	</div>
	<div id="footer">
		<!--
		To do: put stuf here
		-->
	</div>
</body>
</html>
