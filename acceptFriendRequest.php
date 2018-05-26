<?php
session_start();
include "connect.php";
//$db = mysql_select_db("eyebook");
$username = $_SESSION['username'];
$friend = $_REQUEST['requester'];


//sets the areFriends to 1
$sql = "update friends set areFriends = 1 where user1='".$friend."' and user2='".$username."'";
//echo $sql;
$row = mysqli_query($con,$sql);
if(!$row){
	echo "Query unsuccesful<br>";
}
?>
