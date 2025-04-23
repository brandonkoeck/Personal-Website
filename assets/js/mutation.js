// JavaScript Document
// Declare variables

var elList, addLink, newEl, newText, counter, listItems, itemNameInput;
elList = document.getElementById('list'); // Location for newly added list items
addLink = document.getElementById('addToList'); // Bind element for event to add item to list
counter = document.getElementById('counter'); // Place to update items in list
itemNameInput = document.getElementById('itemName'); // NEW- Input box for item name

function addItem(e) { // Declare function to process newly added item event
	
	e.preventDefault(); // Prevent link action when page is not ready
	
	// NEW- add item name
	var itemName = itemNameInput.value.trim(); // Get and trim input value

    if (itemName === "") { // Check if input is empty
        alert("Please enter an item name."); // Alert user if input is empty
        return; // Exit function if input isn't given
    }
	
	newEl = document.createElement('div'); // Create new div inside our shopping list
	newText = document.createTextNode(itemName); // NEW- Text node for item name
	newEl.classList.add('alert'); // Add the alert class to the newly created div
	newEl.classList.add('alert-info'); // Add additional class to newly created div
	newEl.appendChild(newText); // Add text to div
	newEl.addEventListener('click', removeItem, false); // NEW- Create click event lister to remove item when clicked
	
	elList.appendChild(newEl); // Add fully configured div to shopping list
	
	itemNameInput.value = ""; // NEW- Clear input box after adding item

}

function updateCount() { // Declare function to update shopping list count
	
	listItems = elList.getElementsByTagName('div').length; // Get the total number of divs inside our list
	counter.innerHTML = listItems; // Update the shopping list count
	
}

// NEW- Create function to remove item from list

function removeItem(e) {
	
	elList.removeChild(e.target); // Remove selected item
	updateCount(); // Update shopping list count after item is removed
	
}



addLink.addEventListener('click', addItem, false); // Listen for the click event on the button
elList.addEventListener('DOMNodeInserted', updateCount, false); // Listen for the DOM to be updated