<?php
session_start();
$username = $_SESSION['username'];
include "connect.php";
//$con = mysqli_connect("localhost","root","nopassword","eyebook");




function printSentFriendRequests($username)
{
	///echo "Yess";
	include "connect.php";
	$sql = "select user2 from friends where user1='".$username."' and areFriends = 0";
	//echo $sql;
	if(!$con)
	{
		echo "Connection variable not working";
		echo $transferVariable;
	}
	$row = mysqli_query($con,$sql);
	if($row)
	{
		//echo "<br>Keeeka<br>";
	}
	$numberOfRows = mysqli_num_rows($row);
	echo "<table>";
	for ($i = 0 ;$i < $numberOfRows; $i++)
	{
		echo "<tr
			style='border:1px solid green;
	border-radius: 20px;
	background-color:";
	$color = (160 + $i * 40)%244;
	$color2 = (244 -( $i + 1) * 30)%244;
	$color3 = (60 +  $i *50)%244;
	echo "rgb(".$color3.",".$color2.",".$color.")";
	echo ";
	padding:5px 5px 5px 5px;'>";
		$retVal = mysqli_fetch_assoc($row);
		$friend = $retVal['user2'];	



		if($friend)
		{
	//	echo "query unsuccesful";
		}
		echo "<td>".$friend."</td>";
		echo "<td><button id=\"".$friend."\" onclick=\"unfriend('".$friend."')\"> Friend Request Sent</button></td>\n";
		echo "</tr>";
	}
	echo "</table>";
}




function printRecievedFriendRequests($username)
{
	include "connect.php";
	$sql = "select user1 from friends where user2='".$username."' and areFriends = 0";

	$row = mysqli_query($con,$sql);
	$numberOfRows = mysqli_num_rows($row);
	if(!$numberOfRows)
	{
		echo "<br>No one<br>";
	}
	echo "<table>";
	for ($i = 0; $i < $numberOfRows; $i++){
		echo "<tr
			style='border:1px solid green;
	border-radius: 20px;
	background-color:";
	$color = (160 + $i * 40)%244;
	$color2 = (244 -( $i + 1) * 30)%244;
	$color3 = (60 +  $i *50)%244;
	echo "rgb(".$color3.",".$color2.",".$color.")";
	echo ";
	padding:5px 5px 5px 5px;'
		>";
		$retVal = mysqli_fetch_array($row);
		$friend = $retVal[0];
		echo "<td>".$friend."</td>";
		echo "<td><button id=\"".$friend."\" onclick=\"acceptFriendRequest('".$friend."')\">
		Accept friend request</button></td>";
		echo "</tr>";
	}
	echo "</table>";

}





function printFriendList($username)
{
	include "connect.php";
	$sql = "select username from profile where username in (select user1 from friends where user2='".$username."' and areFriends = 1) or username in (select user2 from friends where user1='".$username."' and areFriends=1)";
	echo "<table>";
	$row = mysqli_query($con,$sql);
	$numberOfRows = mysqli_num_rows($row);
	if(!$numberOfRows)
	{
		echo "<tr>";
		echo "Hello ".$username." it looks like
		<br> you don't have any friends.
		<br> Send friend requests to people.";
	}
	for ( $i = 0; $i < $numberOfRows; $i ++)
	{

		echo "<tr
	style='border:1px solid green;
	border-radius: 20px;
	background-color:";
	$color = (160 + $i * 40)%244;
	$color2 = (244 -( $i + 1) * 30)%244;
	$color3 = (60 +  $i *50)%244;
	echo "rgb(".$color3.",".$color2.",".$color.")";
	echo ";
	padding:5px 5px 5px 5px;'
		>";
		$retVal = mysqli_fetch_array($row);
		$friend = $retVal[0];
		echo "<td>".$friend."</td> ";
		echo "<td><button id=\"".$friend."\" onclick=\"unfriend('".$friend."')\">
		unfriend</button></td>\n";
		echo "<td>
		<button id='chat".$friend."' value='".$friend."'
		 onclick='sendMessage(\"".$friend."\")'>Chat</button><br></td>";
		echo "</tr>";
	}
	echo "</table>";
}






function printRecommendedFriends($username)
{
	include "connect.php";
	$sql = "select username from profile where username not in";
	$sql .= "(select user1 from friends where user2='".$username."')";
	$sql .= " and username not in";
	$sql .= "(select user2 from friends where user1='".$username."')";
	$sql .= "and not username='".$username."'";






	//echo $sql;
	$row = mysqli_query($con,$sql);
	$numberOfRows = mysqli_num_rows($row);
	//echo "<h1>Other People</h1>";
	echo "<table>";
	$_SESSION['colorNumber'] = 0;
	for ( $j = 0; $j < $numberOfRows; $j++)
	{
		$retVal = mysqli_fetch_assoc($row);
		$other = $retVal['username'];
		$stillOther = $other;
		echo "<tr
		style='border:1px solid green;
	border-radius: 20px;
	background-color:";
	$color = (160 + $_SESSION['colorNumber'] * 40)%244;
	$color2 = (244 -( $_SESSION['colorNumber'] + 1) * 30)%244;
	$color3 = (60 +  $_SESSION['colorNumber'] *50)%244;
	$_SESSION['colorNumber'] ++;
	echo "rgb(".$color3.",".$color2.",".$color.")";
	echo ";
	padding:5px 5px 5px 5px;'
		>";
		echo "<td>".$other."</td>";
		echo "<td><button id=\"".$other."\" onclick=\"sendFriendRequest('".$other."')\" value=\"0\">+Add Friend</button></td>";

	}
	echo "</table>";
}