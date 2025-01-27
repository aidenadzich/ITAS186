<?php

/* 
Task 1 (35%): 
1. Fetch all tasks (task description and status) from todo-list.txt and store the results a string variable ($tasks_string). This var should be String type.
Your var should look like this:
	"5ece4797eaf5e|Invent a teleportation device.|new
	6770758a1d713|Teach cats to speak fluent English.|new";
Tip: Check out file_get_contents() to get contents. Don't forget to check the file exists!
*/
if (file_exists("todo-list.txt")) {
	$tasks_string = file_get_contents("todo-list.txt");
} else {
	die("File not found");
}


/* 
2.Convert the string to an array variable ($raw_tasks) so each line of todo-list.txt is an item in the array.
This array should look something like this:
	array(
	"5ece4797eaf5e|Invent a teleportation device.|new",
	"6770758a1d713|Teach cats to speak fluent English.|new"
	)
Tip: Look at the explode() function.
*/
if (!empty($tasks_string)) {
	$raw_tasks = explode("\n", trim($tasks_string));

} else {
	die("No tasks found");
}

/* 
3. Convert the array from step 2 into a multidimensional array and assign it to a new variable named $normalized_tasks:
Your final array should look something like this:
	array(
		array(
			"id" => "5ece4797eaf5e",
			"content" => "Invent a teleportation device.",
			"status" => "new"
		),
		array(
			"id" => "6770758a1d713",
			"content" => "Teach cats to speak fluent English.",
			"status" => "new"
		),
		...,
	)
Tip: Check out the explode() and array_push() functions.
*/
$normalized_tasks = [];

foreach ($raw_tasks as $task) {
	$task_parts = explode("|", $task);
	$normalized_tasks[] = [
		"id" => $task_parts[0],
		"content" => $task_parts[1],
		"status" => $task_parts[2]
	];
}

?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Task List</title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>

	<body class="bg-gray-100">
		<div class="max-w-[600px] mx-auto mt-10 bg-white shadow p-4 rounded">
			<div class="flex justify-between">
				<h1 class="text-xl font-bold">PHP Task List</h1>
				<a href="createForm.html" class="text-blue-500">Create</a>
			</div>

			<div class="my-4">
				<?php
				/* 
					Task 2 (35%): 
					Loop through $normalized_tasks and place 'content' it into corresponding fieldset by status
					If the $normalized_tasks array contains no items of a status print a message indicating so instead of the task list.
					Below is example HTML markup with example task items to use for your task fieldset.
				*/

				$new_tasks = [];
				$in_progress_tasks = [];
				$done_tasks = [];

				foreach ($normalized_tasks as $task) {
					if ($task["status"] === "new") {
						$new_tasks[] = $task["content"];
					} elseif ($task["status"] === "in progress") {
						$in_progress_tasks[] = $task["content"];
					} elseif ($task["status"] === "done") {
						$done_tasks[] = $task["content"];
					}
				}
				function render_fieldset($title, $tasks, $class) {
					echo "<fieldset class='border border-{$class}-500 p-4 rounded text-{$class}-500'>";
					echo "<legend class='font-bold'>{$title}</legend>";
					if (count($tasks) > 0) {
						echo "<ul class='list-disc list-outside mx-4'>";
						foreach ($tasks as $task) {
							echo "<li class='my-2'>{$task}</li>";
						}
						echo "</ul>";
					} else {
						echo "<p class='mx-4'>No tasks available.</p>";
					}
					echo "</fieldset>";
				}
				render_fieldset("New", $new_tasks, "green");
				render_fieldset("In Progress", $in_progress_tasks, "blue");
				render_fieldset("Done", $done_tasks, "gray");
				?>
				
				
				
				
				
				
			</div>
		</div>
	</body>

</html>