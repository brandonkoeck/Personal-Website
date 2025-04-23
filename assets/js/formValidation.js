// JavaScript Document

document.getElementById('contactForm').addEventListener('input', validateData, false);

// Single function for all validation using constant variables for each area
function validateData(event) {
    const input = event.target;
    const id = input.id;
    const value = input.value.trim();
    let isValid = true;
    let message = '';

	// First & last name validation (same)
    switch (id) {
        case 'firstName':
        case 'lastName':
            if (!/^[a-zA-Z'-]{2,}$/.test(value)) {
                isValid = false;
					message = `${id === 'firstName' ? 'First name' : 'Last name'} can contain only alphabet characters, hyphens, or apostrophes with a minimum of 2 characters.`;

            }
			
            break;
			
	// Email validation w/ provided regex
		case 'email': { // Added brackets for error: "unexpected lexical declaration in case block"
            const validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!validRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address.';
            }
			
            break;
}
						
	// Phone validation
        case 'phone':
            if (!/^\d{10}$/.test(value)) {
                isValid = false;
                message = 'Phone number must be exactly 10 digits and cannot contain hyphens or parentheses.';
            }
			
            break;

	// Username and password validation (same)
        case 'username':
        case 'password':
            if (value.length < 6) {
                isValid = false;
                message = `${id.charAt(0).toUpperCase() + id.slice(1)} must contain at least 6 characters.`;
            }
			
            break;

	// Comment validation
        case 'comments':
            if (!value) {
                isValid = false;
                message = 'Please enter a comment.'; // Because Empty = NULL
            }
			
            break;
    }

    const group = document.getElementById(`${id}Group`);
    const status = document.getElementById(`${id}Status`);

	// If-else statement for success or failure status messages
	
    if (isValid) {
		
        group.classList.remove('has-error');
        group.classList.add('has-success');
        status.innerText = '';
		
    } else {
		
        group.classList.remove('has-success');
        group.classList.add('has-error');
        status.innerText = message;
		
    }
}
