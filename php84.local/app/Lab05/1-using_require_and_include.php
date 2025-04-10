<?php

/*
TASK 1: Using require() and include()
1. Create a new PHP file named "header.php".
   a. Add HTML code for a simple header section with a heading (e.g., <h1>Welcome to My Website</h1>).
   b. Save the file in the same directory as this PHP file.
2. Create another PHP file named "footer.php".
   a. Add HTML code for a footer section with a message (e.g., <footer>Thank you for visiting!</footer>).
   b. Save the file in the same directory as this PHP file.
3. In this file:
   a. Use include() to add the "header.php" content.
   b. Add some html directly in this file
   c. Use require() to add the "footer.php" content.
		- Hint: include() will only show a warning if the file is missing, but require() will stop execution.
4. Test this file by running it in a browser and check if both the header and footer are displayed.
*/

include('header.php');

echo "<main>";
echo "<p>This is the main content of the page.</p>";
echo "</main>";

require('footer.php');
?>
