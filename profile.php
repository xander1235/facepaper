<?php
	session_start();
	include "connect.php";
	unset($_POST['username']);
	//echo $_COOKIE['name'];
	$_SESSION['colorNumber'] = 0;
	if(isset($_SESSION['username']))
	{
	}
	else{
	session_destroy();
	header("Location: index.php");
			# code...
	}	
	$username = $_SESSION['username'];
	//$sql = "select alias from profile where username=".$username;
	//$row = mysqli_query($con,$sql);
	//$retVal = mysqli_fetch_assoc($row);
	//$alias = $retVal['alias'];
	if(isset($_GET['alias']) && !isset($_SESSION['aliasBool']))
	{

		//$username = $alias;
		$_SESSION['aliasBool'] = 1;
	}
else if(isset(($_GET['alias'])) && $_SESSION['aliasBool'] == 1)
{
	echo "Keka";
	$username = $_SESSION['username'];
	unset($_SESSION['username']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>profile page</title>
	<script src="profile.js">
	</script>
	<script type="text/javascript">
	function friend(friend)
	{
		window.alert(friend);
		var btn = document.getElementById(friend);
		//window.alert(btn.value);
		var i = btn.value;
		window.alert(i);
		/*switch(i)
		{

			case 0:
				window.alert("case 0");
				btn.value = 3;
				sendFriendRequest(friend);
				break;

			case 1
				btn.value = 0;
				unfriend(friend);
				break;

			case 2:
				btn.value = 1;
				acceptFriendRequest(friend);
				break;

			case 3:
				btn.value = 0;
				unfriend(friend);
				break;

			default:
				window.alert("No cases selected " + i);

		}*/
		if( i == 0)
		{
			btn.value = 3;
			sendFriendRequest(friend);
		}
		else if(i == 1)
		{
			btn.value = 0;
			unfriend(friend);
		}
		else if( i == 2)
		{
			btn.value = 1;
			acceptFriendRequest(friend);
		}
		else if( i == 3)
		{
			btn.value = 0;
			unfriend("friend");
		}
	}









	function unfriend(friend)
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)	
			{
			//window.alert(this.responseText);
			
				var btn = document.getElementById(friend);
				btn.innerHTML = "+ Add Friend";
				btn.onclick = "sendFriendRequest("+ friend+")";
				
			}
		}
		xmlhttp.open("GET","unfriend.php?friend="+friend,true);
		xmlhttp.send();
	}

	function acceptFriendRequest(friend)
	{
	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				//window.alert(this.responseText);
				var btn = document.getElementById(friend);
				btn.innerHTML = "Friends";
					btn.onclick="";
			}
		}
		xmlhttp.open("GET","acceptFriendRequest.php?requester=" + friend,true);
		xmlhttp.send();
	}
	function sendFriendRequest(friend)
	{
		var btn = document.getElementById(friend);
		//window.alert(btn.value);
		btn.innerHTML = "Friend Request Sent";
		btn.onclick = "";
	//indow.alert(friend);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
		//window.alert("yes");
			if(this.readyState == 4 && this.status == 200)
			{
	//		window.alert(this.responseText);
			var x = this.responseText;
			}

		}
		xmlhttp.open("GET","sendFriendRequest.php?friend=" + friend,true);
		xmlhttp.send();
	}



	var t = 0;
	function toggle()
	{
		var e = document.getElementById("test");
		var btn = document.getElementById("btn");
		switch(t)
		{
			case 0:
				window.alert(btn.value);
				btn.value = 1;
				e.innerHTML = "1";
				t = 1;
				break;
		
			case 1:
				window.alert(btn.value);
				btn.value = 0;
				t = 0;
				e.innerHTML = "0";
		}

	}






	function deletePost(id)
	{
		var xmlhttp = new XMLHttpRequest();
		window.alert("Button pressed and id is "+ id);
		var btn = document.getElementById(id);
		xmlhttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{
				//btn.style.display = "none";
				var k = "div"+id;
				var post = document.getElementById(k);
				post.style.display = none;
				window.alert(this.responseText);

			}
		}
		xmlhttp.open("GET","deletePost.php?id="+id,true);
		xmlhttp.send();
	}



	function openChatBox(friend)
	{
		var chatBox = document.getElementById("chatBox");
		chatBox.style.display = "block";
	}




	function onloadFunction()
	{
		var images = document.getElementsByClassName('postImages');
		var numberOfImages = images.length;
		var i;
		var height;
		var width;
		var ratio;
		for ( i = 0; i < numberOfImages; i ++)
		{
			height = images[i].clientHeight;
			width = images[i].clientWidth;
			if ( height > width)
			{
			}
			else
			{
				ratio = 500 /width;
			}
			height *= ratio;
			width *= ratio;
			images[i].style.height = height;
			images[i].style.width = width;
				
		}
	}	




	function addComment(id,username)
	{
		

				var xmlhttp = new XMLHttpRequest();
		
		var btn = document.getElementById("comment"+id);
		var post = document.getElementById("commentsDiv" + id);
		var par = document.createElement("p");

		
		var strong = document.createElement("strong");
		var user = document.createTextNode(username);
		strong.appendChild(user);
		post.appendChild(strong);
		var text = document.forms["commentForm"+id]['comment'].value;
		//window.alert("comment.php?postId="+id+"&text="+text);
		var comment = document.createTextNode(text);
		par.appendChild(comment);
		
		post.appendChild(par);
		xmlhttp.onreadystatechange = function ()
		{
			if(this.readyState == 4 &&  this.Status == 200 )
			{
				//window.alert("comment.php?postId="+id+"&text="+text);
			}
		}
		xmlhttp.open("GET","comment.php?postId="+id+"&text="+text,true);
		xmlhttp.send();
		var input = document.getElementById("input"+id);
		input.value = '';
		input.innerHTML = '';
	}
	function addCommentToTheClientSide(id,username)
	{

	}
	function redirectToGroupPage(id,username)
	{
		window.location.href = "group.php?groupId=" + id+"&groupName="+username;
	}
	</script>
</head>


<?php
if(isset($_POST["upload"]))
{


	$sql = "select max(id) from images";
	$row = mysqli_query($con,$sql);
	$retVal = mysqli_fetch_array($row);
	$id = $retVal[0] + 1;//gets the id of the last image + 1
	//echo $id;
	$fileName = basename($_FILES['uploadPic']['name']);
	$sql = "insert into images (imageName) value ('".$fileName."')";
	$row = mysqli_query($con,$sql);
	$imageAddress = "images/image".$id;

	if(move_uploaded_file($_FILES['uploadPic']['tmp_name'],$imageAddress))
	{
			//echo "Image Uploaded";
	}
	else
	{
		//echo "Image not uploaded";
	}

	$sql = "update profile set profilePicId=".$id." where username='".$username."'";
	$row = mysqli_query($con,$sql);
	if($row)
	{
		//echo "Database updated";
	}
	else
	{
		//echo "Database not updated";
		//echo "<br>".$sql;
	}
	//reloadPage();
	//echo $id;
	//$home = "/var/www/html/facepaper/";
	//$image = $_FILES['image'];
	//$imageAddress = "images/image".$id;
}
function reloadPage()
{
	header("Refresh:0");
}
?>

















<body onload="onloadFunction()" id="body">
<form action="logout.php">
	<button style="float:right">LOG OUT</button>
</form>
<form action="profile.php" method="GET">
	<input type='submit' value='Alias mode' name='alias'>
</form>
<!--button onclick="toggle()" value="0" id="btn">Click This</button>
<div id="test" style="width:100px;height:100px;"></div--> 

<?php
if(isset($_GET['alias']) && !isset($_SESSION['aliasBool']))
{

	$username = $alias;
	$_SESSION['aliasBool'] = 1;
}
else if(isset(($_GET['alias'])) && $_SESSION['aliasBool'] == 1)
{
	echo "Keka";
	$username = $_SESSION['username'];
	unset($_SESSION['username']);
}
echo $username;
?>


<!--a href="chat.php">Chat</a-->
<div style="margin-left:30%;margin-bottom:65px;">
<?php
	






	//shows details	
	$sql = "select * from profile where username='".$username."'";
	//echo $sql;
	$row = mysqli_query($con,$sql);
	$retVal = mysqli_fetch_array($row);
	$numberOfFields = mysqli_num_fields($row);
	$profilePic ="images/image".$retVal[$numberOfFields - 1];
	echo "<img src ='".$profilePic."' alt='Upload a profile pic'
	style='
	width:150px;
	height:150px;
	border-radius:100%;
	border:5px solid #f4f4f4;
	display:inline-block;
	margin-top:30px;
	'>";
	echo "<div style='display:inline-block; margin-left:30px;'>";
	for ( $i = 0; $i < $numberOfFields - 1; $i ++){
		if($i != 1)
			echo "<p style=''>".$retVal[$i]."</p>";
	}



?>
<form method="POST" enctype="multipart/form-data" action="profile.php"><input
type="submit" name="upload" value="upload Pro Pic"> 
	<input type="file"
 name="uploadPic" value="upload"/></form>
</div>
</div>
<?php


?>










<div id="post" style="border:1px solid black;padding: 10px;border-radius: 2px; margin:0px 25% 30px 25%">
	<!--form  id="text" action = "profile.php" method="POST">
				<input type="submit" name="post" value="post">
	</form-->


	<form id="text" name="imageUpload" action="profile.php" enctype="multipart/form-data" method="POST">
	
	<textarea form="text" placeholder="Post your Status" name="text" 
	style=" width: 100%;
    height: 100px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;"></textarea>
	<br><input type="file" name="image" value="image"/>
	<input type="submit" name="post" value="post" style="float:right"/>
	</form>
</div>



<?php
include "postManager.php";
if(isset($_POST['post']))
{
	$sql = "select max(id) from images";
	$row = mysqli_query($con,$sql);
	$retVal = mysqli_fetch_array($row);
	$id = $retVal[0] + 1;//gets the id of the last image + 1
	//echo $id;

	//echo $id;
	$home = "/var/www/html/facepaper/";
	$image = $_FILES['image'];
	$imageAddress = "images/image".$id;

	$text = $_POST['text'];
	//echo $text;
	$acceptImage = 	isset($_FILES['image']) && basename($_FILES['image']['name']) != $_SESSION['recentImage'];
	if($acceptImage)
	{
		//echo "Image is accepted";
		
			$fileName = basename($_FILES['image']['name']);
			$sql = "insert into images (imageName) value ('".$fileName."')";
			$row = mysqli_query($con,$sql);
			
			
			if(move_uploaded_file($_FILES['image']['tmp_name'], $imageAddress))
			{

				$_SESSION['recentImage'] = basename($_FILES['image']['name']);
				$_SESSION['id'] = $id;
				echo "file uploaded";
			}
			else
			{	
				echo "file not uploaded";		
			}
		
	}
	$acceptText =isset($text) && $_SESSION['text'] != $text;
	if($acceptText)
	{
		//echo "Boolean is working";
		$_SESSION['text'] =$text;

		if($text)
			echo "tested".$text;
		else
			echo "Text not updated";
	}

	if($acceptImage && $acceptText)
	{
		$sql = "insert into posts (text, image,user) values ('".$text."','".$imageAddress."','".$username."')";
		//echo $sql;
		$row = mysqli_query($con,$sql);
		if($row)
		{
			echo "<br>Posted<br>";
		}
	}
}	//if(isset($_POST['']))
?>



<div class="container" id="groupsDivision"
style="display:inline-block;float:left;width:300px;">
<a href="createGroup.php">Create Group</a><br>
<?php
echo "<table><tr>";
echo "<th><strong>Your groups</strong><br></th></tr>";
$sql = "select * from groupsAndUsers where username = '".$username."'";
$row = mysqli_query($con,$sql);
$numberOfGroups = mysqli_num_rows($row);
for ( $i = 0; $i < $numberOfGroups; $i++){
	$retVal = mysqli_fetch_assoc($row);

	$sql2 = "select groupName from groups where groupId='".$retVal['groupId']."'";
	$row2 = mysqli_query($con,$sql2);
	$retVal2 = mysqli_fetch_array($row2);
	echo "<tr 
	style='margin:10px 10px 10px 10px;
	padding:10px 10px 10px 10px;

	'
	><td
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
	><p style='display:inline;
	' 
	onclick='redirectToGroupPage(".$retVal['groupId'].",\"".$retVal2['0']."\")' 
	>".$retVal2['0']."</p><br></td></tr>";
}
echo "</table>";
echo "<br><table><tr>";
echo "<th><strong>Groups</strong><br></th></tr>";
$sql3 = "select * from groups where groupId not in "; 
$sql3 .= "(select groupId from groupsAndUsers where username='".$username."')";
//echo $sql3;
$row3 = mysqli_query($con,$sql3);
$numberOfRows = mysqli_num_rows($row3);
for ( $i = 0; $i < $numberOfRows; $i++){
	$retVal = mysqli_fetch_assoc($row3);

//	$sql2 = "select groupName from groups where groupId='".$retVal['groupId']."'";
//	$row2 = mysqli_query($con,$sql2);
//	$retVal2 = mysqli_fetch_array($row2);
	echo "<tr
	style='margin:10px 10px 10px 10px;
	padding:10px 10px 10px 10px;
	
	'
	>
	<td
	style='border:1px solid green;
	border-radius: 20px;
	background-color:";
	$k = $_SESSION['colorNumber'];
	$color = (160 + $_SESSION['colorNumber'] * 20)%244;
	$color2 = (244 -( $_SESSION['colorNumber'] + 1) * 20)%244;
	$color3 = (60 +  $_SESSION['colorNumber'] *20)%244;
	
	$_SESSION['colorNumber'] ++;
	echo "rgb(".$color3.",".$color2.",".$color.")";
	echo ";
	padding:5px 5px 5px 5px;'
	>
	<p 
	style='display:inline'
	 onclick='redirectToGroupPage(".$retVal['groupId'].",\"".$retVal['groupName']."\")'
	  >".$retVal['groupName']."</p>
	  <br></td></tr>";
}
echo "</table>";
//echo "</form>";
?>





</div>
<div class="container" style="border-radius: 2px;float:left;padding: 10px 10px 10px 10px ">
<!--This part of the code prints all the posts-->
<?php
 
 $sql = "select id,text,image,user from  posts where user='".$username."' or user in (";
 $sql .= "select user1 from friends where user2='".$username."' and areFriends = 1)";
 $sql .= "or user in (";
 $sql .= "select user2 from friends where user1='".$username."' and areFriends = 1) order by id desc";
 //echo $sql;
 $row = mysqli_query($con,$sql);

 $numberOfRows = mysqli_num_rows($row);
 //echo "The numberOfRows is ".$numberOfRows;
 for($i = 0;$i < $numberOfRows; $i++)
 {
 	$retVal =mysqli_fetch_assoc($row);
 	$ide = $retVal['id'];
 	//echo $ide;
 	
 	echo "<div class='posts' style='border:5px solid #929aa0;border-radius:10px;
 	margin: 20px; padding:5px;
' id ='div".$retVal['id']."'>";

 	
 	echo "<h1>".$retVal['user']."posted this</h1>";
 	echo "<p>".$retVal['text']."</p>";
 	echo "<img class='postImages' src='".$retVal['image']."' style='width:550px;
 	height:550px;
 	border:7px solid #f4f4f4;
 	margin: 20px;
 	'/>";

 	//<button onclick='deletePost(".$retVal['id'].")' id='".$retVal['id']."'>Delete Post</button>";


 	
 	//Print Comments
 	$sql = "select * from comments where postId=".$ide;
 	$row2 = mysqli_query($con,$sql);
 	$numberOfRows2= mysqli_num_rows($row2);

	echo  	"<div id='commentsDiv".$ide."'>";
 	for ( $j = 0;$j < $numberOfRows2; $j++)
 	{
 		$retVal2 = mysqli_fetch_assoc($row2);

 		echo "<strong>".$retVal2['username']."</strong>";
 		echo "<p>".$retVal2['comment']."</p>";
 	}
 	echo "</div>";
 	echo "<form name='commentForm".$ide."'><label for='comment'>".$username."</label><input type='text' id='input".$ide."' name='comment' placeholder='Enter your comment here'/></form><button id='comment".$ide."' onclick='addComment(".$ide.",\"".$username."\")'>Comment</button>";
 	
 	


 	//adds comment

 	echo "</div>";
 	
 }
 
?>
</div>






















<?php
include "printFriends.php";
$username = $_SESSION['username'];












?>

<div id="friendList" style="display:block;float: right;border:5px solid #929aa0;
border-radius:10px;
background-color:#d3eae4;
padding: 10px 10px 10px 10px;">
<?php

	?>
	
	<?php
	echo "<br><br><br><strong>Friend Requests</strong><br>";
	/**shows friend requests that are to be accepted;
	*/
	printRecievedFriendRequests($username);


	/**shows sent friend requests
	**/

	echo "<br><br><br><strong>Sent Requests</strong><br>";
	printSentFriendRequests($username);
	



	echo "<br><br><br><strong>Friends</strong><br>";
	//shows friends
	printFriendList($username);







	//shows recomended friends
	echo "<br><br><br><strong>People you may know</strong><br>";
	printRecommendedFriends($username);

?>
</div>













</body>
</html>