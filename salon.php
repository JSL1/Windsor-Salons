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
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
.salonprofilepic {
	float:right;
	padding: 20px;
	width: 200px;
	height:200px;
	border-radius:10px;
	border: 1px dotted green;
}
.Saloninfo {
	width: 600px;
	padding:10px;
}
h1 {
	font-family: 'Yanone Kaffeesatz', sans-serif;
}
h2 {
	font-family: 'Yanone Kaffeesatz', sans-serif;
}
.review {
	width: 600px;
	border: 1px dotted green;
	border-radius: 5px;
	margin: 10px;
	padding: 5px;
}
#reviewbox {
	width:600px;
	height:200px;
	background-color:black;
	color:white;
	border-radius:10px;
	margin:10px;
	border:1px dotted green;
}
#reviewbox textarea {
	background-color:black;
	border: none;
	color: white;
	width:500px;
	height:120px;
	margin: 0px auto;
}
#rform {
	margin:20px;
}
</style>
<script type="text/javascript">
function display(id) {
var obj = document.getElementById('reviewbox');
if (obj.style.display == "none") {
obj.style.display = "block"
    }
else {
    obj.style.display = "none"
    }
return false
}
</script>
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
<div class="ntext"></div>
<br />
<div id="results">
<?php
function clean($string) {
	$string = str_replace('"', '', $string); // Replaces all spaces with hyphens.
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

$salonid = clean($_GET['salon']);

if (!empty($salonid)) {
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT * FROM Salons WHERE ID = '$salonid'";
	$data = mysqli_query($dbc, $query);

	while($result = mysqli_fetch_array($data)) {
		echo '<img src="./img/scissors.jpg" class="salonprofilepic" />';
		echo '<table class="Saloninfo">';
		echo '<tr>';
		echo '<td><h1>' . $result['Salon_name'] . '</h1></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><h2>' . $result['address'] . ', ' . $result['city'] . '</h2></td>';
		echo '</tr>';		
		echo '<tr>';
		echo '<td>' . $result['description'] . '</td>';
		echo '</tr>';
		echo '<tr><td><p><a href="#" onclick="display(reviewbox)">Review this salon!</a></p></td></tr>';
		echo '<tr><td><p><small><a href="claim.php?salon= ' . $salonid . '">I own this business!</a></small></p></td></tr>';
		echo '</table>';
	}
} else {
echo "<h1>No salon specified</h1>";
}
?>
<?php 
if (!isset($_SESSION['Username'])) {
		echo '&nbsp;&nbsp;&nbsp;You are not logged in. - You need to <a href="index.php?u=login">log in</a> to submit a review';
	} else {
?>
<div id="reviewbox" style="display:none">
	<form name="reviewform" action="reviewprocess.php" method="POST" id="rform">
		<input type="text" name="reviewtitle" value="review title" class="searchbar" />
		<select name="reviewscore" form="reviewform">
		  <option value="0">0</option>
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		  <option value="10">10</option>
		</select><br />
		<textarea name="reviewbody" class="reviewbody">
		</textarea>
				<input type="hidden" name="salonid" value="<?php echo $_GET['salon']; ?>" />
		<br />
		<input type="submit" value="Submit Review" class="button" />
	</form>
</div>
<?php
}
?>
<?php
$query2 = "SELECT * FROM Reviews WHERE salon_Id = '$salonid' and isApproved = 'y'";
$data2 = mysqli_query($dbc, $query2);

	while ($result2 = mysqli_fetch_array($data2)) {
		echo '<div class="review">';
		echo '<b>' . $result2['review_title'] . ' - ' . $result2['review_score'] . '/10</b> - ';
		echo '<a href="viewprofile.php?user=' . $result2['author'] . '">' . $result2['author'] . '</a><br />';
		echo '<p class="reviewtext">' . $result2['review_body'] . '</p>';
		echo '</div><br />';
	}
?>
</div>
<div id="footer">
	<a href="index.php"><img src="./img/logo.png" alt="Hair" id="logo" /></a>
</div>
</body>
</html>
