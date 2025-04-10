<?php
/**
 * PHP String Manipulation and Regular Expressions Lab
 *
 * Instructions: Complete the tasks below in order. Each task focuses on
 * string evaluation, manipulation, and regular expressions using PHP.
 * Follow the instructions provided in the comments, and refer to PHP's
 * official documentation for additional help.
 * Echo out <br> tags between multiple echo or print_r statements within each task.
 * These have been done for you (with <hr> tags as well) between each task to keep things organized. You may also want to echo out the task name (plus a <br>) above your code for each task to help you identify the sections.
 */

/** Task 1 (10%): Basic String Operations */
// 1. Define a string variable named `$message` with the value "   Hello, World!   "
// 2. Remove any leading or trailing whitespace using the appropriate function.
// 3. Print the cleaned-up string to the browser.

$message = "   Hello, World!   ";
$cleanedMessage = trim($message);
echo $cleanedMessage;

echo "<br><hr><br>"; // Separator for page formatting; put code for task 1 above this line.

/** Task 2 (10%): Special Characters Handling */
// 1. Define a string `$htmlString` with the value "<h1>Welcome to PHP!</h1>".
// 2. Convert the HTML characters to their corresponding HTML entities.
// 3. Print both the original and converted string to verify the result.

$htmlString = "<h1>Welcome to PHP!</h1>";
$convertedString = htmlspecialchars($htmlString);
echo "Original: $htmlString<br>";
echo "Converted: $convertedString";

echo "<br><hr><br>"; // Separator for page formatting; put code for task 2 above this line.

/** Task 3: String Manipulation */
// 1. Create a variable `$sentence` with the value "php is awesome".
// 2. Replace the word "awesome" with "amazing".
// 3. Capitalize the first letter of each word.
// 4. Print the final result.

$sentence = "php is awesome";
$sentence = str_replace("awesome", "amazing", $sentence);
$sentence = ucwords($sentence);
echo $sentence;

echo "<br><hr><br>"; // Separator for page formatting; put code for task 3 above this line.

/** Task 4 (10%): String Splitting and Joining */
// 1. Define a string `$csv` with the value "apple,banana,cherry".
// 2. Split the string into an array using the comma as a delimiter.
// 3. Join the array back into a string using a semicolon (;) as the delimiter.
// 4. Print both the array and the joined string.

$csv = "apple,banana,cherry";
$array = explode(",", $csv);
$joinedString = implode(";", $array);
print_r($array);
echo "<br>";
echo $joinedString;

echo "<br><hr><br>"; // Separator for page formatting; put code for task 4 above this line.

/** Task 5 (15%): String Length and Substring */
// 1. Define a string `$longString` with the value "PHP is a popular general-purpose scripting language."
// 2. Calculate and print the length of the string.
// 3. Extract the substring "popular" from the string and print it.

$longString = "PHP is a popular general-purpose scripting language.";
echo "Length: " . strlen($longString) . "<br>";
echo "Substring: " . substr($longString, 9, 7);

echo "<br><hr><br>"; // Separator for page formatting; put code for task 5 above this line.

/** Task 6 (15%): String Position and Case Comparison */
// 1. Compare the string "PHP" with "php" for case-sensitive and case-insensitive matches.
// 2. For each the case sensitive and case insensitive comparisons, write a logic statement that outputs whether the first string is greater than, equal to, or less than the second string.

$string1 = "PHP";
$string2 = "php";

echo "Case-sensitive comparison: ";
if ($string1 === $string2) {
    echo "Equal";
} elseif ($string1 > $string2) {
    echo "Greater";
} else {
    echo "Less";
}
echo "<br>";

echo "Case-insensitive comparison: ";
if (strcasecmp($string1, $string2) === 0) {
    echo "Equal";
} elseif (strcasecmp($string1, $string2) > 0) {
    echo "Greater";
} else {
    echo "Less";
}
echo "<br><hr><br>"; // Separator for page formatting; put code for task 6 above this line.

/** Task 7 (15%): Substring Replacement */
// 1. Define a string `$replaceHTML` with the value:
"<body>
	<h1>The grass is greener on the other side.</h1>
	<p>But the grass is not always greener on this side.</p>
</body>";
// 2. Get the 3 substrings "<body>", "<h1>The grass is greener on the other side.</h1>" and "<p>But the grass is not always greener on this side.</p></body>" into 3 variables.
// 2. Replace "greener" with "always greener" only in substring "<h1>The grass is greener on the other side.</h1>".
// 3. Reassemble and Print the modified html string, escaped with htmlspecialchars().

$replaceHTML = "<body>
    <h1>The grass is greener on the other side.</h1>
    <p>But the grass is not always greener on this side.</p>
</body>";

$bodyStart = substr($replaceHTML, 0, 6); // "<body>"
$h1 = substr($replaceHTML, 6, 43); // "<h1>The grass is greener on the other side.</h1>"
$p = substr($replaceHTML, 49, 82); // "<p>But the grass is not always greener on this side.</p></body>"

$h1Modified = str_replace("greener", "always greener", $h1);
$modifiedHTML = $bodyStart . $h1Modified . $p;
echo htmlspecialchars($modifiedHTML);

echo "<br><hr><br>"; // Separator for page formatting; put code for task 7 above this line.

/** Task 8 (10%): Regular Expressions */
// 1. Define a string `$text` with the value "The quick brown fox jumps over the lazy dog.".
// 2. Check if the word "fox" exists in the string using a regular expression.
// 3. Replace all vowels in the string with an asterisk (*) using a regular expression.
// 4. Print the modified string.

$text = "The quick brown fox jumps over the lazy dog.";
if (preg_match("/fox/", $text)) {
    echo "The word 'fox' exists in the string.<br>";
} else {
    echo "The word 'fox' does not exist in the string.<br>";
}

$modifiedText = preg_replace("/[aeiou]/i", "*", $text);
echo $modifiedText;

echo "<br><hr><br>"; // Separator for page formatting; put code for task 8 above this line.
?>
