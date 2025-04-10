<?php
// File 4: returning_values.php

/*
TASK 4: Returning Values
1. Create a PHP function named "calculateSum":
   a. The function should accept two parameters, both numbers.
   b. It should return the sum of the two numbers.
2. Call the function with two sample numbers (e.g., 5 and 10) and store the result.
3. Display the returned value using echo.
*/

function calculateSum($num1, $num2) {
    return $num1 + $num2;
}

$result = calculateSum(5, 10);

echo "The sum of 5 and 10 is: $result";
?>

