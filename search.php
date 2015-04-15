<?php
session_start();

require_once('./connectvars.php');

?>
<!DOCTYPE html>
<html>
<head>
	<META CHARSET="UTF-8">
	<title>Windsor Salon Search Engine Reviews Find Coupons Deals </title>
	<link rel="stylesheet" type="text/css" href="windsorSalons.css" />
</head>
<body>
<div id='container'>
<p id="loggedin">
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
<br />
<div id="bar">
	<form action="search.php"  method="GET">
		<input type="text" name="searcht" class="searchbar" size="60" />&nbsp;&nbsp;&nbsp;
		<input type="submit" name="submit" class="button" value='Search Windsor Salons' />
	</form>
</div>
<br />
<div class="ntext">Search Results:</div>
<br />
<div id="results">
<?php
function clean($string) {
	$string = str_replace('"', '', $string); // Replaces all spaces with hyphens.
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

$srcht = clean($_GET['searcht']);
if (!empty($srcht)) {
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT * FROM Salons WHERE Salon_name LIKE '%{$srcht}%' OR description LIKE '%{$srcht}%' OR address LIKE '%{$srcht}%' OR city LIKE '%{$srcht}%'";

	$data = mysqli_query($dbc, $query);

	while($result = mysqli_fetch_array($data))
	{
		echo '<div class="searchresult">';
		echo "<u><a href='salon.php?salon=" . $result['ID'] . "'>" . $result['Salon_name'] . "</a></u><br />";
		echo " ";
		echo $result['address'];
		echo "<br>";
		echo $result['city'];
		echo "<br>";
		echo $result['description'];
		echo "</div><br />";
	}
	$srcherr = "";
} else {
	$srcherr = "<span id='searcherror'>No Search Term Entered/No Matches Found</span>";
}
echo $srcherr;
?>
</div>
<div id="footer">
	<a href="index.php"><img src="./img/logo.png" alt="Hair" id="logo" /></a>
</div>
</body>
</html>
