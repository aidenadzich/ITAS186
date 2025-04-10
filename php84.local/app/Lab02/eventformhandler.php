<?php

// 70'

// Finish the form input name and buttons in eventform.php as per lab instructions

// Determine if displaying card; true to display card
$validation = true;

// Error message placeholder
$msg = "";

// Title input
if (isset($_POST["title"]) && !empty($_POST["title"])) {
  $title = htmlspecialchars($_POST["title"]);
} else {
  $validation = false;
  // todo (5%): add error message indicating title is empty.
  $msg .= "Title is required.<br>";
}
// Instructions: For each todo below handle that input. You must:
// 1: Test that the value is set. If it is not set and the field is required set an error message indicating so and the validation flag to false.
// 2: If the value is set, ensure it is normalized to the expected data type (text, bool, etc.), and validate it using PHP's built-in validation functions (https://www.w3schools.com/php/php_form_validation.asp). This value should be set to a variable.


// todo (10%): Handle 4 Feature input checkboxes
$features = [];
if (isset($_POST['features']) && is_array($_POST['features'])) {
    foreach ($_POST['features'] as $feature) {
        $features[] = htmlspecialchars($feature);
    }
} else {
    $validation = false;
    $msg .= "At least one feature must be selected.<br>";
}
// todo (10%): Handle Start and input dates
if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
  $start_date = htmlspecialchars($_POST['start_date']);
  if (!strtotime($start_date)) {
      $validation = false;
      $msg .= "Invalid start date format.<br>";
  }
} else {
  $validation = false;
  $msg .= "Start date is required.<br>";
}

if (isset($_POST['end_date']) && !empty($_POST['end_date'])) {
  $end_date = htmlspecialchars($_POST['end_date']);
  if (!strtotime($end_date)) {
      $validation = false;
      $msg .= "Invalid end date format.<br>";
  }
} else {
  $validation = false;
  $msg .= "End date is required.<br>";
}

// todo (5%): HandleDescription text
if (isset($_POST['description']) && !empty($_POST['description'])) {
  $description = htmlspecialchars($_POST['description']);
} else {
  $validation = false;
  $msg .= "Description is required.<br>";
}

// todo (10%): Check if the end date is greater than start date
// if no, set $validation to false and populate $msg with error message.
if (isset($start_date, $end_date) && strtotime($start_date) >= strtotime($end_date)) {
  $validation = false;
  $msg .= "End date must be greater than start date.<br>";
}


// todo (10%): create a simple HTML card to hold form submission data. The template is as follows but requires additions.


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Submission result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-300">
  <div class="flex min-h-screen items-center justify-center">
    <div class="relative flex w-full max-w-[48rem] flex-row rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
      <?php if ($validation) { ?>
        <div class="relative m-0 w-2/5 shrink-0 overflow-hidden rounded-xl rounded-r-none bg-white bg-clip-border text-gray-700">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="image" class="h-full w-full object-cover" />
        </div>
        <div class="p-6 flex-1">
          <h4 class="mb-2 block font-sans text-2xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
            <?php
            echo $title;
            ?>
          </h4>
          <p class="mb-8 block font-sans text-base font-normal leading-relaxed text-gray-700 antialiased">
            <!-- todo (5%): Print event description here -->
            <?php echo $description; ?>
          </p>

          <div class="flex justify-between w-full">
            <!-- todo (5%): Fill start and end dates below -->
            <span>Start: <?php echo $start_date ?></span>
            <span>End: <?php echo $end_date ?></span>
          </div>

          <div>
            <!-- todo (10%): use foreach to print the submitted features -->
            <ul>
                <?php foreach ($features as $feature) { ?>
                    <li><?php echo $feature; ?></li>
                <?php } ?>
            </ul>
          </div>

        </div>
      <?php } else { ?>
        <div class="text-xl p-8">
          <h2>Something went wrong</h2>
          <!-- todo (10%): add the error message indicating the reason for the error. -->
          <p><?php echo $msg; ?></p>

          <!-- todo (5%): add an anchor to link the form page -->
          <a href="eventform.php" class="text-blue-500 underline">Go back to the form</a>
        </div>

      <?php } ?>
    </div>
  </div>
</body>

</html>