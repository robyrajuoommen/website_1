<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:index.php");
}
require "sqlconfig.php";
$_GET['id']=$_SESSION['user'];
if(isset($_GET['id']))
{
$id=$_GET['id'];
$sql="SELECT * FROM employee WHERE empid='$id'";
$result=mysqli_query($con,$sql);
// $f=mysqli_fetch_array($result);
}
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
  color: black;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit; /* Important for vertical align on mobile phones */
  margin: 0; /* Important for vertical align on mobile phones */
}

/* Add a red background color to navbar links on hover */
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: blue;
}

/* Add black color to Dropdown button text on hover */
.dropbtn:hover {
  color:black;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100px;
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
img{
	border-radius: 50%;
}
	</style>

</head>
<body>
	<?php while($f=mysqli_fetch_array($result)){ ?>
	<div style="float:right;"><h3 style="float:left; padding-top: 5%;">Welcome <?php echo ucfirst($f['name']); ?>!</h3> 
	 <div class="dropdown" style="float:right;margin-left: 10px;">
    <button class="dropbtn"><span style="display:inline;"><?php echo "<img src='uploads/".$f['image']."' width='50' height='50' alt='User'/>";?>&#9660;</span>
    </button>
   <div class="dropdown-content">
      <a href="update.php?id=<?php echo $f['id'];?>">Edit Profile</a>
      <a href="logout.php">Logout</a>
    </div>
  </div> 
  </div>
	<h2 align="center"><u>PROFILE</u></h2>
	<br><br><br>
<table align="center" border="1">
	<tr>
		<th>EmployeeId</th>
		<th>Name</th>
		<th>Department</th>
		<th>Skills</th>
		<th>Age</th>
		<th>Gender</th>
		<th>Address</th>
		<th>PhoneNo</th>
		<th>EmailId</th>
	</tr>

<tr>
	<td><?php echo $f['empid']; ?></td>
	<td><?php echo $f['name']; ?></td>
	<td><?php echo $f['department']; ?></td>
	<td><?php echo $f['skills']; ?></td>
	<td><?php echo $f['age']; ?></td>
	<td><?php echo $f['gender']; ?></td>
	<td><?php echo $f['address']; ?></td>
	<td><?php echo $f['phone']; ?></td>
	<td><?php echo $f['email']; ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>