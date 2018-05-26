function getHint(string)
{
	//var string = document.forms['searchForm']['search'].value;
	var hint = document.getElementById("hints").innerHTML;
	hint = string;
	var x = XMLHttpRequest();
	x.onreadystatechange = function()
	{
		if( this.readyState == 4 && this.status == 200)
		{
			document.getElementById("hints").innerHTML = this.responseText;
		}
	};
	x.open("GET","getHint.php?searchTerm="+string,true);
	x.send();
}

function sendFriendRequest(friend,username)
{
	var btn = document.getElementById(friend);
	window.alert(btn.value);
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
			btn.onclick = "";
			
		}
	}
	xmlhttp.open("GET","unfriend.php?friend="+friend,true);
	xmlhttp.send();
}

