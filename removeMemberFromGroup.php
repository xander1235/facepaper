<?php
session_start();
include "connect.php";
$member = $_REQUEST['member'];
$groupId = $_SESSION['groupId'];
$sql = "delete from groupsAndUsers where groupId=".$groupId." and username='".$member."'";
echo $sql;
$row = mysqli_query($con,$sql);
