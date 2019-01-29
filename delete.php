<?php
require "sqlconfig.php";
$delete=$_GET['id'];
$sql="DELETE FROM employee WHERE id='$delete'";
mysqli_query($con,$sql);
header("location:view.php");
?>