<?php
include "connect.php";
session_start();
$username = $_REQUEST['username'];
$groupId=$_SESSION['groupId'];
$sql = "update groupsAndUsers set isAdmin = 1 where username='".$username."' and groupId=".$groupId;
$row = mysqli_query($con,$sql);