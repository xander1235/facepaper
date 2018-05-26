function validate(i)
{
//window.alert(i);

	switch(i)
	{

		case 0:
		
			//window.alert("Working");
			var error = document.getElementById("passwordError");
			var x = document.forms['signup']['password'].value;
			var y = document.forms['signup']['repeatPassword'].value;
			error = x;
			if(x != y)
			{
				error.innerHTML="Not the Same";
			}
			else
			{
				error.innerHTML="Not the Same";
			}
			
	}
}