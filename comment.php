<?php
include "connect.php";
session_start();
$username = $_SESSION['username'];
$postId = $_REQUEST['postId'];
$text = $_REQUEST['text'];
//echo $text;
$sql = "insert into comments ( username, postId, comment ) value ('".$username."',".$postId.",'".$text."')";
echo $sql;
$row = mysqli_query($con,$sql);
