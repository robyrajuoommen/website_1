<?php
//preventing direct url access
/*
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
}
*/
require "sqlconfig.php";
if(isset($_POST['btn']))
{
	$empid=$_POST['empid'];
	$name=$_POST['name'];
	$department=$_POST['dept'];
	$skill = implode(',',$_POST['skill']);
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$address=$_POST['addr'];
	$phone=$_POST['ph'];
	$email=$_POST['mail'];
	$password=$_POST['pass'];

	// $sql1="SELECT COUNT(*) FROM employee WHERE empid = '$empid'";
	// $result=mysqli_query($con,$sql1);
	// if ($result>=1)
	// 	{ $message = "Employee Id Already Exists!";
	// echo "<script type='text/javascript'>alert('$message');</script>";
	// 	}
	// else{
	$sql2="INSERT INTO employee(empid,name,department,skills,age,gender,address,phone,email,password) VALUES('$empid','$name','$department','$skill','$age','$gender','$address','$phone','$email','$password')";
	mysqli_query($con,$sql2);
	// }
}
?>
<html>
<head>
<title></title>
<style type="text/css">
input[type='text']{
     height:30px;
}

input[type='number']{
	 width:100%;
	 height:30px;
}

textarea{
	height:50px;
}

fieldset{
	width:45%;
	height:100%;
	border-radius:20px;
}

select{
	width:100%;
}

button{
	width:150px;
	height:40px;
}

span{
	display:inline-block;
	width:20%;
}

</style>
</head>
<body>
	<div align="center">
	<form method="post" name="regForm">
		<fieldset>
		<legend align="center"><strong>REGISTRATION</strong></legend>
	<table>
		<br><br>
		<tr>
			<td><b>Employee Id:</b><br><br></td>
			<td><input type="text" name="empid" size="60" placeholder="Enter Your Employee Id (eg: emp001)" onFocusOut="return validateEmpId(document.regForm.empid);"><br><br></td>
		</tr>

		<tr>
			<td><b>Name:</b><br><br></td>
			<td><input type="text" name="name" size="60" placeholder="Enter Your Name" onFocusOut="return validateName(document.regForm.name);" required><br><br></td>
		</tr>

		<tr>
			<td><b>Department:</b><br><br></td>
			<td><input type="checkbox" name="dept" value="web" onClick="clearGroup(this);">Web Development
				<input type="checkbox" name="dept" value="seo" onClick="clearGroup(this);">SEO
				<input type="checkbox" name="dept" value="app" onClick="clearGroup(this);">Mobile Development
				<input type="checkbox" name="dept" value="network" onClick="clearGroup(this);">Network<br><br>
		</tr>

		<tr>
			<td><b>Skill(s):</b><br>(Use CTRL to<br>select multiple)<br><br></td>
			<td><select name="skill[]" multiple="multiple" required>
  					<option value="php">PHP</option>
  					<option value="javascript">Javascript</option>
  					<option value="photoshop">Photoshop</option>
  					<option value="analytics">Analytics</option>
  					<option value="android">Android</option>
  					<option value="ccna">CCNA</option>
				</select><br><br></td>
		</tr>

		<tr>
			<td><b>Age:</b><br><br></td>
			<td><input type="number" name="age" placeholder="Enter Your Age" required><br><br></td>
		</tr>

		<tr>
			<td><b>Gender:</b><br><br></td>
			<td align="center">
				Male<input type="radio" id="male" value="male" name="gender">
			    Female<input type="radio" id="female" value="female" name="gender"><br><br>
			</td>
		</tr>

		<tr>
			<td><b>Address:</b><br><br></td>
			<td><textarea name="addr" cols="62" placeholder="Enter Full Address" required></textarea><br><br></td>
		</tr>

		<tr>
			<td><b>Phone:</b><br><br></td>
			<td><input type="text" name="ph" maxlength="10" onFocusOut="return validatePhone(document.regForm.ph);" size="60" placeholder="Enter Your Phone Number" required><br><br></td>
		</tr>

		<tr>
			<td><b>Email:</b><br><br></td>
			<td><input type="text" name="mail" onFocusOut="return validateEmail(document.regForm.mail);" size="60" placeholder="Enter Your EmailId" required><br><br></td>
		</tr>

		<tr>
			<td><b>Password:</b><br><br></td>
			<td><input type="text" name="pass" onFocusOut="return validatePassword(document.regForm.pass);" size="60" placeholder="Enter Password" required><br><br></td>
		</tr>

		<tr>
			<td></td>
			<td align="center"><button type="submit" onClick="return validateGender();"" name="btn">REGISTER</button><span></span><button type="reset">RESET</button></td>
		</tr>
	</table>
	</fieldset>
	</form>
	</div>
	<script type="text/javascript">

function validateEmpId(empid) {
	emp =/([a-z]){3}([0-9]){3}/;
 	if(!emp.test(empid.value))
 		{
	        alert("Please Check Your Employee Id!");
	        form.empid.focus();
	        return false;
	    }
	}


function validateName(name) {
	var usr =/^[a-zA-Z\s]+$/;
	   if (name.value.match(usr)) 
	   {  
	    return true; 
	   }  
	    alert("Please Enter Your Name!")  
	    return false;
	   }


	function clearGroup(elem) {
        var group = document.regForm.dept;
        for (var i=0; i<group.length; i++) {
            if (group[i] != elem) {
                group[i].checked = false;
            }
        }
    }


function validateGender() {
if(document.getElementById('male').checked==false && document.getElementById('female').checked==false)
			{
				alert("Please select your Gender");
				return false;
			}
			return true;
}

	function validatePhone(phone) {
	    var phoneno =/^\d{10}$/;
	    if (phone.value.match(phoneno)) 
	  {  
	    return true; 
	  }  
	    alert("Please enter a valid phone number!")  
	    return false;
	}

	function validateEmail(mail)   
	{  
		var pattern=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
	 if (mail.value.match(pattern)) 
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