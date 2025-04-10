<?php

/*
TASK 7: Using Namespaces
1. Create a new file alongside this one. Call it something like "labTasks.php".
    a. Inside labTasks.php define a namespace named "LabTasks":
    b. Inside the namespace in labTasks.php, create a function named "displayTask":
        i. The function should accept one parameter: the task description (a string).
        ii. Display the task description using echo.
2. In this file (the global scope):
   a. Include the labTasks.php file.
   b. Call the "displayTask" function using the namespace.
   - Hint: Use "\NamespaceName\FunctionName" to access a namespaced function from the global scope.
*/

include 'labTasks.php';

\LabTasks\displayTask("This is a message.");
?>

