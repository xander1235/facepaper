<?php
include "connect.php";
//echo "In the php file, xmlhttp working fine";
$username = $_REQUEST['username'];
$groupId= $_REQUEST['groupId'];
$sql = "insert into groupsAndUsers (groupId,username) value (".$groupId.",'".$username."')";
$row = mysqli_query($con,$sql);
