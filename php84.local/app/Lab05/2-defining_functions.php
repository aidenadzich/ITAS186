<?php

/*
TASK 2: Defining Functions
1. Create a PHP function named "greetUser":
   a. The function should accept one parameter: the user's name.
   b. It should return a greeting message, e.g., "Hello, [name]! Welcome to PHP!".
2. Call the function with a sample name (e.g., "John") and store the result.
3. Call the function and display the returned message using echo.
   - Hint: Look up "PHP function syntax" if needed.
*/

function greetUser($name) {
   return "Hello, $name! Welcome to PHP!";
}

$greetingMessage = greetUser("John");

echo $greetingMessage;