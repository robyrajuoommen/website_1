<?php
//preventing direct url access
/*
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
}
*/
session_start();  
require "sqlconfig.php";
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="SELECT * FROM employee WHERE email='$username' && password='$password'";
	$res=mysqli_query($con,$sql);
	$fe=mysqli_fetch_array($res);
	$count=mysqli_num_rows($res);
	if($count>=1)
	{
		$_SESSION['user']=$fe['empid'];
		header("location:profile.php");
	}
}
?>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
<form method="POST" name="logForm">
	<fieldset style="width:45%;height:60%;border-radius:20px; margin-top:10%;"">
		<legend align="center"><strong>USER LOGIN</strong></legend>
<table align="center" style="padding-top: 20%;">
	<tr>
		<td>Username: <br><br></td>
		<td><input type="text" name="username" placeholder="Enter EmailId" onfocusout="return validateEmail(document.logForm.username);" size="40" required><br><br></td>
	</tr>
	<tr>
		<td>Password: <br><br></td>
		<td><input type="password" name="password" placeholder="Enter password" onfocusout="return validatePassword(document.logForm.password);" size="40" required><br><br></td>
	</tr>
	<tr>
		<td></td>
		<td align="center"><button type="submit" name="login" style="width:100px;height:40px;">LOGIN</button><span style="display:inline-block; width:10%;"></span><button type="reset" style="width:100px;height:40px;">RESET</button></td>
	</tr>
	<tr>
		<td></td>
	<td><br><span style="display:inline-block; width:20%;"></span><a href="register.php" align="right">New User? Register Here &rarr;</a></td>
	</tr>
</table>
</fieldset>
</form>
</center>
<script type="text/javascript">
	
function validateEmail(username)   
	{  
		var pattern=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
	 if (username.value.match(pattern)) 
	  {  
	    return true; 
	  }  
	    alert("Please enter a valid email address!")  
	    return false; 
	} 

function validatePassword(password) {
	     re = /[0-9]/;
	      if(!re.test(password.value)) {
	        alert("Error: password must contain at least one number (0-9)!");
	        form.password.focus();
	        return false;
	      }
	      re = /[a-zA-Z]/;
	      if(!re.test(password.value)) {
	        alert("Error: password must contain at least one letter (a-zA-Z)!");
	        form.password.focus();
	        return false;
	      }
	       re = /[!@#\$%\^&]/;
	      if(!re.test(password.value)) {
	        alert("Error: password must contain at least one special character (!@#$^%&)!");
	        form.password.focus();
	        return false;
	      }
	        if(password.value.length < 8) {
	        alert("Error: Password must contain at least 8 characters!");
	        form.password.focus();
	        return false;
	      }
	}

</script>

</body>
</html>