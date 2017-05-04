<html>
<head>
	<title>My Restaurant</title>
</head>

<body>

<?php
	if ((isset($_COOKIE['isLoggedIn'])) && ($_COOKIE['isLoggedIn'] == 'Yes')) {
?>

<form action="addMenuItem_Submit.php" method="post">
	<br />
	<table>
		<tr>
			<td colspan=2>
				<center>
				Add Menu Item
				</center>
			</td>
		</tr>
		<tr>
			<td>
				Item Name:
			</td>
			<td>
				<input type="text" name="txtItemName" />
			</td>
		</tr>
		<tr>
			<td>
				Item Group:
			</td>
			<td>
				<select name="optItemGroup">
					<option value="beverage">Beverage</option>
					<option value="breakfast">Breakfast</option>
					<option value="lunch">Lunch</option>
					<option value="dinner">Dinner</option>
					<option value="appetizer">Appetizer</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Price (e.g. $1.00):
			</td>
			<td>
				<input type="text" name="txtPrice" />
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<center>
				<input type="submit" value="Add Item">
				</center>
			</td>
		</tr>
	</table>

</form>

<?php
	}
	else {
		if (isset($_COOKIE['isLoggedIn'])) {
			setcookie("isLoggedIn", "", time()-3600);
		}
		echo '<script>window.location.href="index.php"</script>';
	}
?>




</body>
</html>
