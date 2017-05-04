<html>
<head>
	<title>My Restaurant</title>
</head>

<body>

<?php
	if ((isset($_COOKIE['isLoggedIn'])) && ($_COOKIE['isLoggedIn'] == 'Yes')) {

		$postItemName = $_POST['txtItemName'];
		$postItemGroup = $_POST['optItemGroup'];
		$postPrice = $_POST['txtPrice'];	

		include 'dbConnection.php';
		
		$mysqli = new mysqli($host, $user, $password, $database);	
		if ($mysqli->connect_error) {
    			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}


		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare("INSERT INTO items (itemName, itemGroup, itemPrice) VALUES(?, ?, ?)")) {
			$stmt->bind_param("sss", $postItemName, $postItemGroup, $postPrice);
			$stmt->execute();
			$stmt->close();
			$mysqli->close();
			echo '<script>window.location.href="loginCheck.php"</script>';
		}


?>

	


<?php
	}
	else {
		if (isset($_COOKIE["isLoggedIn"])) {
			setcookie("isLoggedIn", "", time()-3600);
		}
		echo '<script>window.location.href="index.php"</script>';
	}
?>




</body>
</html>
