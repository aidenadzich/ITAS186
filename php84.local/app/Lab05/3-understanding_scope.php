<?php

/*
TASK 3: Understanding Scope
1. Create a global variable named "$globalVar" and set its value to 10.
2. Define a function named "scopeExample":
   a. Inside the function, access "$globalVar".
   b. Set a local variable "$localVar" to 20.
   c. Display the values of both "$globalVar" and "$localVar" inside the function using echo.
3. Outside the function:
   a. Call "scopeExample" to execute the function.
   b. Display the value of "$globalVar" to confirm its scope.
   c. Attempt to access the value of "$localVar" outside the function in which it's declared to confirm its scope.
*/

$globalVar = 10;

function scopeExample() {
    global $globalVar; // Access the global variable
    $localVar = 20; // Declare a local variable
    echo "Inside the function:<br>";
    echo "Global Variable: $globalVar<br>";
    echo "Local Variable: $localVar<br>";
}

scopeExample();

echo "<br>Outside the function:<br>";
echo "Global Variable: $globalVar<br>";

echo "Attempting to access local variable outside the function:<br>";
if (isset($localVar)) {
    echo "Local Variable: $localVar<br>";
} else {
    echo "Local Variable is not accessible outside the function.<br>";
}
?>
