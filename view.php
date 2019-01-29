<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("location:index.php");
}
require "sqlconfig.php";
$sql="SELECT * FROM employee";
$e=mysqli_query($con,$sql);
$count=mysqli_num_rows($e);
if(isset($_POST['del']))
{
$delid = $_POST['delid'];
$nc = count($delid);
for($i=0;$i<$nc;$i++)
{
    $did = $delid[$i];
    $sql1="DELETE FROM employee WHERE id='$did'";
    mysqli_query($con,$sql1);
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=view.php\">";
}
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
	</style>
</head>
<body>
<h2 align="center"><u>VIEW LIST</u></h2><br>
<div style="float:right;margin-right: 20px;"> 
<div class="dropdown">
    <button class="dropbtn"><?php echo "<img src='admlog.png"."' width='50' height='50' alt='User'/>";?>&#9660;</button>
   <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div><br><br>
<form method="post">
	<br><br><br><br>
<table align="center" border="1">
<tr>
<th><u>Select</u></th>
<th><u>Employee Id</u></th>
<th><u>Name</u></th>
<th><u>Department</u></th>
<th><u>Skills</u></th>
<th><u>Age</u></th>
<th><u>Gender</u></th>
<th><u>Address</u></th>
<th><u>Phone</u></th>
<th><u>Email</u></th>
<th><u>Actions</u></th>
</tr>
<?php
while($f=mysqli_fetch_object($e)){
?>
<tr>
<td align="center"><input type="checkbox" name="delid[]" value="<?php echo $f->id; ?>"></td>
<td><?php echo $f->empid; ?></td>
<td><?php echo $f->name; ?></td>
<td><?php echo $f->department; ?></td>
<td><?php echo $f->skills; ?></td>
<td><?php echo $f->age; ?></td>
<td><?php echo $f->gender; ?></td>
<td><?php echo $f->address; ?></td>
<td><?php echo $f->phone; ?></td>
<td><?php echo $f->email; ?></td>
<td><button type="submit"><a href="delete.php?id=<?php echo $f->id; ?>">DELETE</a></button></td>
</tr>
<?php
}
?>
<td><button type="submit" name="del" style="font-size: 10px;">DELETE MULTIPLE</a></button></td>
</table>
</form>
</body>
</html>