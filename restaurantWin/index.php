<html>
<head>
	<title>My Restaurant</title>
</head>

<body>

Menu<br />
<br />
Beverages<br />

<?php
	setcookie("isLoggedIn", "", time()-3600);

	include 'dbConnection.php';

	$mysqli = new mysqli($host, $user, $password, $database);
 	if ($mysqli->connect_error) {
	    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
	}

	$stmt = $mysqli->stmt_init();
	if ($stmt->prepare("SELECT itemName, itemPrice FROM items WHERE itemGroup='beverage'")) {
		$stmt->execute();
		$stmt->bind_result($outItemName, $outPrice);
		while ($stmt->fetch()) {
?>

		<?php echo $outItemName; ?>&nbsp;&nbsp;&nbsp;<?php echo $outPrice; ?><br />
		
				
<?php

		}
	}
	$stmt->close();
	$mysqli->close();


?>

<form action='loginCheck.php' method='post'>
<table>
	<tr>
		<td colspan=2>
			<center>
				Login
			</center>
		</td>
	</tr>
	<tr>
		<td>
			Username:
		</td>
		<td>
			<input type='text' name='txtUsername' />
		</td>
	</tr>
	<tr>
		<td>
			Password:
		</td>
		<td>
			<input type='password' name='txtPassword' />
		</td>
	</tr>
	<tr>
		<td colspan=2>
			<center>
				<input type=submit value='Login' />
			</center>
		</td>
	</tr>
</table>


</form>
</body>
</html>


	
