<?php
session_start();
include "connect.php";
$username = $_SESSION['username'];
$friend = $_REQUEST['friend'];
$sql = "delete from friends where ( user1='".$friend."' and user2 ='".$username."') or (user2 = '".$friend."' and user1 ='".$username."') ";
$row = mysqli_query($con,$sql);
if(!$row)
{
	echo "Query Unsuccesful";
}
else
{
	echo "Query Succesful";
}