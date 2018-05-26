<?php
	session_start();
	include "connect.php";
	$username = $_SESSION['username'];
	include "printFriends.php";
	$sql = "select username from profile where username in (";
	$sql .= "select user1 from friends where user2 = '".$username."' 
	and areFriends=1) or ";
	$sql .= "username in (select user2 from friends 
		where user1='".$username."' and areFriends = 1)";
	$friends = mysqli_query($con,$sql);
	$temp = $friends;
	$zero = mysqli_fetch_array($temp);
	$firstFriend = $zero['0'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chatting</title>
	<script type="text/javascript">

		function sendMessage(friend)
		{
			var text = document.getElementById('text');
			var k = text.value;
			//window.alert(k);
			
			var  xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function ()
			{
				if(this.status == 0 && this.readyState == 4)
				{

				}
			}
			xmlhttp.open("GET","sendMessage.php?message="+k+"&friend="+friend,true);
			xmlhttp.send();
			
		}
	</script>
</head>
<body>

<?php
//printFriendList($username);
$numberOfFriends = mysqli_num_rows($friends);
echo "<div id='friendsList' style='float:left;width:15%;background-color:red'>";
for ( $i = 0; $i < $numberOfFriends; $i ++)
{
	$retVal = mysqli_fetch_assoc($friends);
	echo "<p style='display:inline-block;
	
	padding:10px 10px 10px 10px;
	background-color: green;
	'>".$retVal['username']."</p><br>";
}
?>
</div>

<div id="chatBox" style="float:right;width:80%;border:2px solid green;height:75%;">
	<div id="messageBox" style="width:inherit;border:2px solid green;height:inherit;" ></div>
	<textarea id='text' name="text" style="resize:none;width:75%;height:20%; margin-top:10px;"></textarea>
<button id="send" onclick="sendMessage()">Send</button>
	
</div>

</body>
</html>