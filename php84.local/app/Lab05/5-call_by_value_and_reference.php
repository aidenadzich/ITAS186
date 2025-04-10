<?php

/*
TASK 5: Call by Value vs Call by Reference
1. Create a PHP function named "modifyValue":
   a. The function should accept one parameter by value.
   b. Increment the parameter by 1 then display its value inside the function.
2. Create another PHP function named "modifyReference":
   a. The function should accept one parameter by reference.
   b. Increment the parameter by 1 then display its value inside the function.
3. Create a variable named "$value" and set it to 5.
4. Call both functions with "$value" and echo $value after each call.
   - Hint: Use the & symbol to pass a parameter by reference.
*/

function modifyValue($param) {
    $param += 1;
    echo "Inside modifyValue: $param<br>";
}

function modifyReference(&$param) {
    $param += 1;
    echo "Inside modifyReference: $param<br>";
}

$value = 5;

modifyValue($value);
echo "After modifyValue: $value<br>";

modifyReference($value);
echo "After modifyReference: $value<br>";
?>

