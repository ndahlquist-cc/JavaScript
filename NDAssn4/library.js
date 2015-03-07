			/*library.js
This program contains multiple fields and validations

Revision History: 2014.01.31 (validations and regex), 2014.02.01 (arrays), 
	2014.02.03 (pascal, uppercase, and trim functions) 
	2014.02.04, 2014.02.05 (move functions to .js file)
	2014.02.06 (comments)
	
Nicole Dahlquist, 2014.01.30: Created 

Test Plan: 
Test that form field inputs are accepted into array
Test validations for empty required fields, cityName length, trimInput function
Test onBlur functioning
Test regular expression functionality
Test focusOrder for errors in fields
Test functions for capitalizing entire words, and changing words to PascalCase
Test functions that were moved to .js file*/

/* this function accepts a variable that contains a 
regular expression and a variable that should contain user input
and compares the two*/
function regEx(regEx, input)
{
	
	// declare boolean variable
	var isGood = false;
	
	// if the user input matches the format of the regular expression
	if (regEx.test(input))
	{
		isGood = true; // change boolean variable to true
	}
	return isGood;
}

/* this function accepts a variable that should contain user
input and changes all characters to uppercase before returning it */
function upperCase(input)
{
	// set the user input to a temporary variable
	var tempVariable = input.value; 
	
	// capitalize the input and assign to a new variable
	var capitals = tempVariable.toUpperCase(); 
	
	// return the capitalized entry to the original input variable
	input.value = capitals;
}

/*window.onload = function()
{
	arrays();
	//varArray[0].focus();
}*/




function trimInput()
{ 
	arrays();  // call the array function to get the values from the text fields
		
	for (var i = 0; i < varArray.length; i++)
	{
		// trim white space from the start and end of each text box entry
		var tempTrim = varArray[i].value.trim();
		
		// return the trimmed entries to the text box array
		varArray[i].value = tempTrim;
	}
}

function pascal()
{
	arrays(); // call the array function to get the values from the text fields
	varArray.splice(4); // remove the postal code value from the array
	varArray.splice(6);
	varArray.splice(7);
	varArray.splice(8);
	// for each text box entry
	for (var j = 0; j < varArray.length; j++)
	{
		var newArray = new Array(); // declare a new array to hold the split entries
		
		// split each text box entry into its own array
		newArray = varArray[j].value.split(" "); 
		
		varArray[j].value = ""; // delete the original array entries
		
		// for each word in the text box entry
		for (var i = 0; i < newArray.length; i++)
		{
			/* change the first letter to uppercase and the rest of the letters
			to lowercase*/
			var tempPascal = newArray[i].substr(0,1).toUpperCase() +
			newArray[i].substr(1).toLowerCase();
			
			// concatenate the words back into a single array element
			varArray[j].value += tempPascal + " ";
			
		}
		
	}	
}


		