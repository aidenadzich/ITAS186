<?php
 /* 
 *   Task 3 (35%). This file should handle submission of the form in login.php as follows:
 * 	  - Check data was posted and this file isn't being accessed directly. Retrieve the data and sanitize appropriate values (for example, do not trim passwords)
 *    - Loop through each row in the `credentials.txt` file and check the username and password match those on a line in the file.
 *    	- If they do not, redirect to login.php with the $_GET attribute set to display a message such as "Username or password not found."
 *    	- If they do
 * 			- Store the username in the session.
 *    		- Store the favorite color in a cookie that lasts for 30 days.
 * 			- Redirect the user to index.php
 *    - HINT: Use `header('Location: ...')` for redirection.
 * 			  Open the Chrome Dev tool's Application tab and look at the cookie data stored for the site!
 * 			  Here you'll see your PHPSESSID cookie that connects your device with the session stored on the server.
 */
