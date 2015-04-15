<?php
	session_start();
	if(isset($_SESSION['Username'])) {
		$_SESSION = array();
		
		if (isset($COOKIE[session_name()])){
			setcookie(session_name(), '', time() - 3600);
		}
		session_destroy();
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<META CHARSET="UTF-8">
	<title>Windsor Salon Search Engine Reviews Find Coupons Deals </title>
	<link rel="stylesheet" type="text/css" href="windsorSalons_old.css" />
</head> 
<body>
	<?php
	if ($error_msg == "") {
		echo '<p class="success">You have successfully logged out!</p>';
		$go = '/working/index.php';
	} else {
		echo '<p class="error"><i>' . $error_msg . '</i></p>';
		$go = '/working/index.php';
	}
	?>
	<div id="form">
	<script type="text/javascript">
		var delay = 3000; 
		setTimeout(function(){ window.location = '<?php echo $go; ?>'; }, delay);
	</script>
	</div>
</body>
</html>
