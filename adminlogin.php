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
	$sql="SELECT * FROM admin WHERE username='$username' && password='$password'";
	$res=mysqli_query($con,$sql);
	$fe=mysqli_fetch_array($res);
	$count=mysqli_num_rows($res);
	if($count>=1)
	{
		$_SESSION['user']=$fe['username'];
		header("location:view.php");
	}
	else
	{
		echo '<script language="javascript">;
			alert("Username or Password is incorrect!");
			</script>';
	}
}
?>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
<form method="POST">
	<fieldset style="width:45%;height:60%;border-radius:20px; margin-top:10%;">
		<legend align="center"><strong>ADMIN LOGIN</strong></legend>
<table align="center" style="padding-top: 20%;">
	<tr>
		<td>Username: <br><br></td>
		<td><input type="text" name="username" placeholder="Enter Username" size="40" required><br><br></td>
	</tr>
	<tr>
		<td>Password: <br><br></td>
		<td><input type="password" name="password" placeholder="Enter password" size="40" required><br><br></td>
	</tr>
	<tr>
		<!-- <td><a href="register.php">REGISTER</a></td> -->
		<td></td>
		<td align="center"><button type="submit" name="login" style="width:100px;height:40px;">LOGIN</button><span style="display:inline-block; width:10%;"></span><button type="reset" style="width:100px;height:40px;">RESET</button></td>
	</tr>
</table>
</fieldset>
</form>
</center>
</body>
</html>
