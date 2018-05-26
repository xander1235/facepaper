<?php
session_start();
include "connect.php";


$postId = $_REQUEST['id'];

$sql = "delete from posts where id = ".$postId;
$retVal = mysql_query($sql);
if($retVal)
{
	echo "Deleted";
}
else
{
	echo "Not Deleted";
}