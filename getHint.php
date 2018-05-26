<?php
echo "GetHint.php started";
include 'connect.php';
//$db = mysql_select_db("eyebook");
$searchTerm = $_REQUEST['searchTerm'];
$sql = "select username as k from profile where k like  '%".$searchTerm."%'";
$row = mysqli_query($con,$sql);
$numberOfRows = mysqli_num_rows($row);
for ($i = 0 ; $i < $numberOfRows ; $i ++)
{
	$retVal = mysqli_fetch_array($row);
	echo $retVal[$i]."&nbsp";
}
?>