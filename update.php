<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:index.php");
}
require "sqlconfig.php";
$update=$_GET['id'];
if(isset($_GET['id'])){
	$sql="SELECT * FROM employee WHERE id='$update'";
	$dat=mysqli_query($con,$sql);
	$sql1="SELECT skills FROM employee WHERE id='$update'";
	$exe=mysqli_query($con,$sql1);
	$sql2="SELECT skills FROM skillset";
	$res=mysqli_query($con,$sql2);
	$count=mysqli_num_rows($res);
}
// $target_dir = "uploads/";
$imagename=$_FILES["fileToUpload"]["name"];
$reimage= time().$imagename;
$target_file = "uploads/" .$reimage;
if(isset($_POST['btn']))
{
	$a=$_POST['empid'];
	$b=$_POST['name'];
	$c=implode(',',$_POST['skill']);
	$d=$_POST['age'];
	$e=$_POST['gender'];
	$g=$_POST['addr'];
	$h=$_POST['ph'];
	$j=$_POST['mail'];
	$k=$_POST['pass'];

// $reimage=rename_image($imagename);

// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else 
    {
        echo "Sorry, there was an error uploading your file.";
    }


$sql3="UPDATE employee SET empid='$a',name='$b',image='$reimage',skills='$c',age='$d',gender='$e',address='$g',phone='$h',email='$j',password='$k' WHERE id='$update'";
mysqli_query($con,$sql3);
header("location:profile.php");
}
  // function rename_image($file_name)
  //   {
		// $info =$file_name;
		// $s=explode('.',$info);
		// $nam=$s[0];
		// $ext=get_extension($info);
		// $date=date('Y-m-d H:i:s');
		// $dte=date('Ymdhis',strtotime($date));
		// $nm=$nam.$dte;
		// $file1=$nm.'.'.$ext;
		// return $file1;
  //   }
?>
<html>
<head>
<title></title>
<style type="text/css">
		
/* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}

/* Dropdown button */
.dropdown .dropbtn {
  font-size: 16px; 
  border: none;
  outline: none;
  color: #e40f0f;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}
h3{
	float:left; 
	padding-top: 5%;
}
	</style>

</head>
<body>
	<?php while($f=mysqli_fetch_array($dat)){?>
	<div style="float:right;"><h3>Welcome <?php echo ucfirst($f['name']); ?>!</h3> 
	 <div class="dropdown" style="float:right;margin-left: 10px;">
    <button class="dropbtn"><span style="display:inline;"><?php 
     echo "<img src='uploads/".$f['image']."' width='50' height='50' alt='User'/>";?>&#9660;</span> 
    </button>
   <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </div> 
  </div>
<div align="center">
	<form method="post" name="upForm" enctype="multipart/form-data">
		<fieldset style="width:45%;height:95%;border-radius:20px;">
			<legend align="center">UPDATE</legend>
		<table align="center">
			<br><br>
			<tr>
				<td><b>Employee Id:</b><br><br></td>
				<td><input type="text" name="empid" value="<?php echo $f['empid']; ?>" size="60" placeholder="Enter Your Employee Id (eg: emp001)" onfocusout="return validateEmpId(document.upForm.empid);" required><br><br></td>
			</tr>
			<tr>
				<td><b>Name:</b><br><br></td>
				<td><input type="text" name="name" value="<?php echo $f['name']; ?>" size="60" placeholder="Enter Your Name" required><br><br></td>
			</tr>

			<tr>
				<td><b>Select image to upload:</b><br><br></td>
				<td><input type="file" name="fileToUpload" id="fileToUpload"><br><br></td> 
			</tr>

			<tr>
			<td><b>Department:</b><br><br></td>
			<td><input type="checkbox" name="dept" value="web" <?php if($f['department']=="web") echo "checked"; ?> onClick="clearGroup(this);">Web Development
				<input type="checkbox" name="dept" value="seo" <?php if($f['department']=="seo") echo "checked"; ?> onClick="clearGroup(this);">SEO
				<input type="checkbox" name="dept" value="app" <?php if($f['department']=="app") echo "checked"; ?> onClick="clearGroup(this);">Mobile Development
				<input type="checkbox" name="dept" value="network" <?php if($f['department']=="network") echo "checked"; ?> onClick="clearGroup(this);">Network<br><br>
			</tr>

			<tr>
				<td><b>Skill(s):</b><br>(Use CTRL to<br>select multiple)<br><br></td>
			<td><select name="skill[]" multiple="multiple" style="width:100%" required >
				<?php while($fe=mysqli_fetch_array($exe)){
				$v=explode(",",$fe['skills']); ?>
  					<option value="php" <?php for($i=0;$i<$count;$i++){if($v[$i]=="php"){echo "selected";}}?>>PHP</option>
  					<option value="javascript" <?php for($i=0;$i<$count;$i++){if($v[$i]=="javascript"){echo "selected";}}?>>Javascript</option>
  					<option value="photoshop" <?php for($i=0;$i<$count;$i++){if($v[$i]=="photoshop"){echo "selected";}}?>>Photoshop</option>
  					<option value="analytics" <?php for($i=0;$i<$count;$i++){if($v[$i]=="analytics"){echo "selected";}}?>>Analytics</option>
  					<option value="android" <?php for($i=0;$i<$count;$i++){if($v[$i]=="android"){echo "selected";}}?>>Android</option>
  					<option value="ccna" <?php for($i=0;$i<$count;$i++){if($v[$i]=="ccna"){echo "selected";}}?>>CCNA</option>
  				<?php }?>
				</select><br><br></td>
			</tr>
			<tr>
				<td><b>Age:</b><br><br></td>
				<td><input type="number" name="age" value="<?php echo $f['age']; ?>" style="width:100%;" placeholder="Enter Your Age" required><br><br></td>
			</tr>
			</tr>
			<td><b>Gender:</b><br><br></td>
			<td align="center">
				Male<input type="radio" value="male" name="gender" <?php if($f['gender']=='male') echo "checked";?>>
			    Female<input type="radio" value="female" name="gender" <?php if($f['gender']=='female') echo "checked";?>><br><br></td>
			</tr>
			<tr>
				<td><b>Address:</b><br><br></td>
				<td><textarea name="addr" cols="62" placeholder="Enter Full Address" required><?php echo $f['address']; ?></textarea><br><br></td>
			</tr>
			<tr>
				<td><b>Phone:</b><br><br></td>
				<td><input type="text" name="ph" value="<?php echo $f['phone']; ?>" size="60"  placeholder="Enter Your Phone Number" onfocusout="return validatePhone(document.regForm.ph);" required><br><br></td>
			</tr>
			<tr>
				<td><b>Email:</b><br><br></td>
				<td><input type="text" name="mail" value="<?php echo $f['email']; ?>" size="60" placeholder="Enter Your Email Id" onfocusout="return validateEmail(document.regForm.mail);" required><br><br></td>
			</tr>
			<tr>
				<td><b>Password:</b><br><br></td>
				<td><input type="text" name="pass" value="<?php echo $f['password']; ?>" size="60" placeholder="Enter Password" onfocusout="return validatePassword(document.regForm.pass);" required><br><br></td>
			</tr>

<?php } ?>
			<tr>
				<td></td>
			<td align="center"><button type="submit" name="btn" style="width:150px;height:40px;">UPDATE</button></td>
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