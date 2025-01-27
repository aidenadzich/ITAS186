<?php
/*
Task 4 (5%):
Receive and assign form data to vars.
Create an ID var populated by uniqid();
*/
$content = $_POST["task"] ?? '';
$status = $_POST["status"] ?? '';

$id = uniqid();


/* 
Task 5 (10%): 
Validate the submitted data to ensure the following is true: 
	1.The task content is required and must not be empty.
	2.Status is required and must be one of the exact strings "new", "in progress" or "done".
	3.Redirect the user back to the task creation page if neither condition is met. Otherwise, store the task and status into a variable $new_task as an associative array with keys "id", "content", and "status" and applicable values.
*/
$is_valid = true;

if (empty($content)) {
	$is_valid = false;
}

$valid_statuses = ["new", "in progress", "done"];
if (!in_array($status, $valid_statuses)) {
	$is_valid = false;
}

if (!$is_valid) {
	header("Location: createForm.html");
	exit();
}

$new_task = [
	"id" => $id,
	"content" => $content,
	"status" => $status
];
	

/*
	Task 6 (10%):
	Convert $new_task into string and append it as a single line at the end of task-list.txt
	for example, if current text file contents are:

	5ece4797eaf5e|Invent a teleportation device.|new
	6770758a1d713|Teach cats to speak fluent English.|new

	Let's say the new task is "new task here." and its status is new. The new content of task list will be:

	5ece4797eaf5e|Invent a teleportation device.|new
	6770758a1d713|Teach cats to speak fluent English.|new
	ID|new task here.|new

	tip: look at the fopen(), fwrite(), and fclose() functions!
*/
$new_task_line = "\n" . $new_task["id"] . "|" . $new_task["content"] . "|" . $new_task["status"];

$file = fopen("todo-list.txt", "a");

if ($file) {
	fwrite($file, $new_task_line);
	fclose($file);
} else {
	die("File not found");
}

// Task 7 (5%): Once done, redirect user to index.php
header("Location: index.php");
exit();