<?php
session_start();
$username =$_SESSION['username'];
include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Group Page</title>
</head>
<body>
<form method="GET" action="createGroup.php">
<label for="groupName">Group Name</label>
	<input name="groupName" type="text">
	<input type="submit" name="create"c value="Create"/>
</form> 
</body>
</html>
<?php
if(isset($_GET['create']))
{
	//add the groupName to the table groups
	$groupName = $_GET['groupName'];
	$sql = "insert into groups (groupName) value ('".$groupName."')";
	$row = mysqli_query($con,$sql);




	//find the group id that is created
	$sql = "select groupId from groups where groupName='".$groupName."'";
	$row = mysqli_query($con,$sql);
	$retVal = mysqli_fetch_assoc($row);
	$groupId = $retVal['groupId'];

	//add the user to the group
	$sql = "insert into groupsAndUsers (groupId,username,isAdmin) value (".$groupId.",'".$username."',1)"; 
	$row = mysqli_query($con,$sql);

	$_SESSION['groupId'] = $groupId;
	$_SESSION['groupName'] = $groupName;
	header("Location: group.php?groupId=".$groupId."&groupName=".$groupName);
}
?>