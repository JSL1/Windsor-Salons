<?php
require_once('./connectvars.php');

session_start();

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

function clean($string) {
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

if (!isset($_SESSION['Username'])) {
	$msg = "You are not logged in.";
} else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$rsalon = clean($_POST['salonid']);
		$rtitle = clean($_POST['reviewtitle']);
		$rbody = clean($_POST['reviewbody']);
		$rauthor = $_POST['Username'];
		if (is_numeric($_POST['reviewscore'])) {
			if (($_POST['reviewscore'] > 11) && ($_POST['reviewscore'] >= 0)) {
				$rscore = $_POST['reviewscore'];
			}
		}
		$risapproved = 'n';

		$query = "INSERT INTO Reviews (salon_Id, review_title, author, review_body, review_score, isApproved) 
                VALUES ('$rsalon', '$rtitle', '$rauthor' , '$rbody', '$rscore', 'n')";
		mysqli_query($dbc, $query);
	
		$msg = "Your review has been submitted for approval by the administrator.";
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<META CHARSET="UTF-8">
	<title>Windsor Salon Search Engine Reviews Find Coupons Deals </title>
	<style type="text/css">
	body {
		color: red;
		text-align:center;
		margin: 0px auto;
	}
	</style>
</head> 
<body>
	<?php
	echo $msg;
	$go = 'index.php';
	?>
	<script type="text/javascript">
		var delay = 3000; 
		setTimeout(function(){ window.location = '<?php echo $go; ?>'; }, delay);
	</script>
	</div>
</body>
</html>
