<?php

echo "Hello World!";
$hello = "<br>" . "Hello PHP";
echo $hello;
$var1 = "<br>" . "Hello";
$var2 = "\rWorld";
echo $var1 . $var2;

$grade = 33;

echo "<br>";

if ($grade >= 60) {
    echo "First Division";
} elseif ($grade > 45 && $grade < 60) {
    echo "Second Division";
} elseif ($grade >= 33 && $grade <= 46) {
    echo "Third Division";
} elseif ($grade < 33) {
    echo "Fail";
}

echo "<br>";

for ($i = 6; $i <= 22; $i++) {
    echo $i . " ";
}

?>