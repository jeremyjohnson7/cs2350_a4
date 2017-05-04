<html>
<head>
	<title>Registration</title>
	<script type="text/javascript">
		function validateForm() 
		{
			var firstName = document.getElementById('txtFirstName').value;
			var lastName = document.registerForm.nameLastName.value;
			if (firstName == "") {
				document.getElementById('errFirstName').hidden = "";
				return false;
			}
			if (lastName == "") {
				document.getElementById('errLastName').hidden = "";
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
<form name="registerForm" action="registerForm_Submit.php" method="post"  onsubmit="return validateForm();" >
Registration Form<br /><br />

First Name: <input type="text" size="25" id="txtFirstName" name="nameFirstName">
<span id="errFirstName" style="color:red" hidden>First name is invalid.</span><br />

Last Name: <input type="text" size="25" id="txtLastName" name="nameLastName">
<span id="errLastName" style="color:red" hidden>Last name is invalid.</span><br />

<input type="submit" value="Submit" onsubmit="return validateForm();" />
</form>
</body>
</html>
