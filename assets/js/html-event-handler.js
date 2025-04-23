// JavaScript Document

function checkUsername() 
{ // Declare function
	
	var elMsg = document.getElementById('feedback'); // Get feedback element
	var elUsername = document.getElementById('username'); // Get username input
	
	if (elUsername.value.length < 5) 
	{ // If username too short
		elMsg.innerHTML = '<h3>Username must be 5 characters or more</h3>'; // Set msg
	}
	
	else 
	{ // Otherwise
		elMsg.innerHTML = '<h3>Username is good</h3>'; // Clear message
	}
	
}
