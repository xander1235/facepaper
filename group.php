<?php
session_start();
include "connect.php";
if(isset($_REQUEST['groupId']) && isset($_REQUEST['groupName']))
{
	$groupName = $_REQUEST['groupName'];
	$groupId = $_REQUEST['groupId'];
	$_SESSION['groupName'] = $groupName;
	$_SESSION['groupId'] = $groupId;
}
else
{
	$groupId = $_SESSION['groupId'];
	$groupName = $_SESSION['groupName'];
}
$username = $_SESSION['username'];
$sql = "select * from groupsAndUsers where username='".$username."' and groupId='".$groupId."'";
$row = mysqli_query($con,$sql);
$retVal = mysqli_fetch_assoc($row);
$isAdmin = $retVal['isAdmin'];
?>
<html>
<head>
<title><?php echo $groupName; ?></title>
<script type="text/javascript">
function addUserToGroup(username,groupId)
{
	var button = document.getElementById(username);
	button.style.display="none";

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			//window.alert(this.responseText);
			var tr = document.createElement("tr");
			var par =document.createElement("td");
			var text = document.createTextNode("\n"+username);
			par.appendChild(text);
			var td = document.createElement("td");
			text = document.createTextNode("+ Admin");
			var btn = document.createElement("button");
			btn.appendChild(text);
			td.appendChild(btn);
			tr.appendChild(par);
			tr.appendChild(td);




			var td = document.createElement("td");
			par = document.createElement("button");
			text = document.createTextNode("Remove");
			par.appendChild(text);
			td.appendChild(par);
			tr.appendChild(td);
			var members = document.getElementById("membersTable");
			members.appendChild(tr);
			//members.appendChild(td);
		}
	}
	//window.alert("addUserToGroup.php?username="+username+"&groupId=");
	xmlhttp.open("GET","addUserToGroup.php?username="+username+"&groupId="+groupId,true);
	xmlhttp.send();

}
function makeUserAdmin(username)
{
	var button = document.getElementById("2"+username);
	button.style.color="green";
	button.innerHTML="Admin";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{

		}
	}
	xmlhttp.open("GET","makeUserAdmin.php?username="+username,true);
	xmlhttp.send();
}
function removeUser(member)
{
	//window.alert("Button working, id="+member);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			//window.alert("removed");
			var deleted = document.getElementById("remove"+member);
			deleted.style.display = "none";
			var tr = document.createElement("tr");
			var td = document.createElement("td");
			var text = document.createTextNode(member);
			td.appendChild(text);
			tr.appendChild(td);




			var btn = document.createElement("button");
			text = document.createTextNode("Add");
			btn.appendChild(text);
			btn.setAttribute("onclick","window.alert('buttonClicked'");
			td = document.createElement("td");
			td.appendChild(btn);
			tr.appendChild(td);
			var main = document.getElementById("notMembersTable");
			main.appendChild(tr);
			window.alert(this.responseText);
		}
	}
	xmlhttp.open("GET","removeMemberFromGroup.php?member="+member,true);
	xmlhttp.send();

}
</script>
</head>
<body>
	<a href="profile.php">Home</a>
	<br>
	<h1><?php echo $groupName; ?></h1>
	<br>
<div id="left" style="float:left">
<div id="members" style="display:inline-block">
	<h2>Members:</h2><br>
<?php
	$sql = "select *  from groupsAndUsers where groupId=".$groupId;
	//echo $sql;
	$row = mysqli_query($con,$sql);
	$numberOfRows = mysqli_num_rows($row);
	echo "<table id='membersTable'>";
	for ($i = 0; $i < $numberOfRows; $i++)
	{
		$retVal = mysqli_fetch_assoc($row);

		echo "<tr id='remove".$retVal['username']."' >";
		echo "<td>".$retVal['username']."</td>";
		if($retVal['isAdmin'] == 1)
		{
			echo "<td style='color:green'>
			Admin</td>";
			echo "<td ><button id='remove".$retVal['username']."' 
				onclick='removeUser(\"".$retVal['username']."\")'>";
			if($retVal['username'] == $username)
			{
				echo	"  &nbsp&nbsp&nbsp&nbspExit&nbsp&nbsp&nbsp&nbsp";
				//echo $retVal['username'];
			}
			else
			{
				echo "Remove";
			}
			echo "</button>";
		}
		else
		{
			if($isAdmin == 1)
			{

				echo "<td id='2".$retVal['username']."'>
				<button onclick='makeUserAdmin(\"".$retVal['username']."\")'>
				+ Admin</button></td>";
				echo "<td ><button  
				onclick='removeUser(\"".$retVal['username']."\")'>";

				
				echo "Remove</button></td>";
			}
		}

		echo "</tr>";
	}
	echo "</table>";
?>
</div>
<br>
<div id='notMembers' style="display:inline-block">
<h2>Add Members</h2>
<?php
$sql = "select username from profile where username not in";
$sql .= "( select username from groupsAndUsers where groupId=".$groupId;
$sql .= ")" ;
$row = mysqli_query($con,$sql);
$numberOfRows = mysqli_num_rows($row);
?>
<table id='notMembersTable'>
<?php
//echo "<table id='notMembersTable'">
for ( $i = 0; $i < $numberOfRows; $i++)
{
	$retVal = mysqli_fetch_assoc($row);
	echo "<tr id='".$retVal['username']."'>";	
	echo "<td>".$retVal['username']."</td>";
	if($isAdmin)
	{
	echo "<td><button  onclick='addUserToGroup(\"".$retVal['username']."\",".$groupId.")'>
	Add</button></td>";
	}
	echo "</tr>";
}






?>




</table>
</div>
</div>
<div id="left" style="display:inline-block">
<?php
//finding if the user is an admin of the page

if($isAdmin)
{
?>

<div id="post" style="border:1px solid black;padding: 10px;border-radius: 2px;
 margin:0px 25% 0px 25%">
	<!--form  id="text" action = "profile.php" method="POST">
				<input type="submit" name="post" value="post">
	</form-->


	<form id="text" name="imageUpload" action="group.php" 
	enctype="multipart/form-data" method="POST">
	
	<textarea form="text" placeholder="Post your Status" 
	name="text" style=" width: 100%;
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
</div>








<?php


if(isset($_POST['post']))
{
	$sql = "select max(id) from images";
	$row = mysqli_query($con,$sql);
	$retVal = mysqli_fetch_array($row);
	$id = $retVal[0] + 1;//gets the id of the last image + 1
	//echo $id;

	//echo $id;
	$home = '/var/www/html/';
	$image = $_FILES['image'];
	$imageAddress = "images/image".$id;
	$text = $_POST['text'];
	$acceptImage = 	isset($_FILES['image']) && 
	basename($_FILES['image']['name']) != $_SESSION['recentImage'];
	if($acceptImage)
	{
		//echo "Image is accepted";
		
			$fileName = basename($_FILES['image']['name']);
			$sql = "insert into images (imageName) value ('".$fileName."')";
			$row = mysqli_query($con,$sql);
			if(!$row)
			{
				echo "Image not added to database";
			}
			//$home = "/var/www/html/images/";
			
			if(move_uploaded_file($_FILES['image']['tmp_name'], $imageAddress))
			{
				
$_SESSION['recentImage'] = basename($_FILES['image']['name']);
				$_SESSION['id'] = $id;
			//	echo "file uploaded";
			}
			else
			{			
			}
		
	}
	$acceptText =isset($text) && $_SESSION['text'] != $text;
	if($acceptText)
	{
		//echo "Boolean is working";
		$_SESSION['text'] =$text;



	}

	//if($acceptImage && $acceptText)
	//{
		$sql = "insert into posts (text, image,user,groupId) values ('".$text."','".$imageAddress."','".$username."',".$groupId.")";
		//echo $sql;
		$row = mysqli_query($con,$sql);
		if($row)
		{
			echo "<br>Posted<br>";
		}

}
}
?>



<div class="container" style="border-radius: 2px;
display:inline-block; 
margin:20px 20px 20px 20px;padding: 10px 10px 10px 10px ">
<!--This part of the code prints all the posts-->
<?php
 
 $sql ="select * from posts where groupId=".$groupId." order by id desc";

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
 	margin: 20px; padding:5px;'

 	id ='div".$retVal['id']."'>
 	";

 	
 	echo "<h1>".$retVal['user']."
 	posted this
 	</h1>";
 	echo "
 	<p>".$retVal['text']."</p>
 	";
 	echo "
 	<img class='postImages' src='".$retVal['image']."' style='width:500px;height:500px;'/>
 	";

 	//<button onclick='deletePost(".$retVal['id'].")' id='".$retVal['id']."'>Delete Post</button>";


 /*	
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
 	
 	
*/

 	//adds comment

 echo "</div>";
 	
 }
 ?>
</body>

</html>