<?php
session_start();
include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<script src="index.js"></script>
	<title>SQL project login page</title>
</head>
<body>
<form action="index.php" method="POST" name="login"
style="float:right">
<input name="username" type="text" placeholder="username" />
<input name="password" type="password" placeholder="password" />
<button name="login" type="submit" value="login">Login</button>
</form>


<?php
if(isset($_POST['login']))
{

	//$con = mysql_connect("localhost","root","1234");
	//$db = mysql_select_db("eyebook");
	//if(!$db)
	//{
	//	echo "Connection unsuccesful";
	//}
	//else
	//{
	//	echo "Connection Succesful";
	//}

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
//		echo "Connection succesful";
		
	//	if($db)
	//	{


			$password = $_SESSION['password'];
//			echo "Database connection succesful\n";
			$sql = "select * from profile where username = '".$_SESSION['username']."'";
			//echo $sql;
			$row = mysqli_query($con,$sql);
			$retVal = mysqli_fetch_assoc($row);
			if($retVal['password'] == $password && isset($_SESSION['username']) )
			{
				
				header("Location: profile.php");
			}
			else
			{
				echo "Enter the correct Password";
			}

	//	}
	//	else
	//	{
	//		echo "Database connection aborted"."<br/>";
	//	}
}	
?>








<br><br><br><br>
<div style="float:right;margin-right:100px">
	<h1 >Sign Up</h1>
<form action="index.php" method="POST" name="signup"
>
<input name="username1" type="text" placeholder="username"/>
<!--br><input name="email" type="email" placeholder="email"/-->
<br><input name="age" type="text" placeholder="age" />
<br><input name="sex" type="text" placeholder="sex"/>
<br><input name="status" type="text" placeholder="status"/>
<br><input name="password1" type="password" placeholder="password"/>
<br>
<input name="repeatPassword" type="password" placeholder="Repeat Password" onkeyup="validate(0)"/>
<br><input type="submit" name="signup" value="Sign Up"/>
<p style="color:red;" id="passwordError"></p>
</form>
</div>





<?php
//include "connect.php";

if(isset($_POST['signup']))
{
		//echo "Signup is set";
		$username = $_POST['username1'];
		$password = $_POST['password1'];
		$sex = $_POST['sex'];
		$status = $_POST['status'];
		$age = $_POST['age'];
		
		$sql ="insert into profile (username,password,age,sex,status) value ('";
		$sql .= $username."','".$password."',".$age.",'".$sex."','".$status."')";
	//	echo $sql;
	//	echo $username." ".$password." ".$sex." ".$status." ".$age;
		$row = mysqli_query($con,$sql);
		if(!$row)
		{
		//	echo "Query Unsuccesful";
		}
		//echo "Congratulations!! you just signed up";
		//$_SESSION['loggedIn'] = 1;
		$_SESSION['username'] = $username;
		//echo $_SESSION['username'];
		if(isset($_SESSION['username']))
		{
			header("Location: profile.php");
		}
}



	

?>
</body>

</html>
