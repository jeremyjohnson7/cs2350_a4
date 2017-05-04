<html>

<head>
	<title>My Restaurant</title>
</head>

<body>

<?php
if (isset($_POST['txtUsername'])) {
	// Pulls in and assigns a PHP variable to the POST variables that are passed
	$postUsername = $_POST['txtUsername'];
	$postPassword = $_POST['txtPassword'];

	// Includes the database connection information
	include 'dbConnection.php';

	// Connects to the database and displays any errors if they are encountered
	$mysqli = new mysqli($host, $user, $password, $database);
 	if ($mysqli->connect_error) {
	    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	// Going to see if the username and password of the user matches what is in the database
	$stmt = $mysqli->stmt_init();
	if ($stmt->prepare("SELECT username, password FROM login WHERE username = ? AND password = ?")) {
		$stmt->bind_param("ss", $postUsername, $postPassword);
		$stmt->execute();
		// After the query is executed then you need to take the results and assign them to variables
		$stmt->bind_result($outUsername, $outPassword);
		// What if there are more than one result, loop through all of the results
		while ($stmt->fetch()) {
			if (($outUsername == $postUsername) == ($outPassword == $postPassword)) {
				echo "Login successful!";
				// Create a cookie to store that the user is logged in
				// This is insecure cause someone could create a cookie and set the variable to Yes
				setcookie("isLoggedIn", "Yes", time()+3600);
			}
		}
	}
	$stmt->close();
	$mysqli->close();
?>

<br /><br />
<a href=addMenuItem.php>Add Menu Item</a>
<br /><br />
<a href=index.php>Return to Home Page</a>
<br /><br />

<?php

}
elseif ($_COOKIE['isLoggedIn'] == 'Yes') {
?>
<br /><br />
<a href=addMenuItem.php>Add Menu Item</a>
<br /><br />
<a href=index.php>Return to Home Page</a>
<br /><br />

<?php

}
else {
	setcookie("isLoggedIn", "", time()-3600);
	echo '<script>window.location.href="index.php"</script>';
}

?>

</body>
</html>
