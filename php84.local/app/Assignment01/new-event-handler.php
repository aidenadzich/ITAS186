<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $startDateTime = trim($_POST['startDateTime'] ?? '');
    $endDateTime = trim($_POST['endDateTime'] ?? '');

    if (empty($name)) {
      header("Location: index.php?message=" . urlencode("Missing required fields."));
      exit;
    } elseif (empty($startDateTime) || empty($endDateTime)) {
      header("Location: index.php?message=" . urlencode("Missing date fields."));
      exit;
    }

    $startDateTimeObj = DateTime::createFromFormat('Y-m-d\TH:i', $startDateTime);
    $endDateTimeObj = DateTime::createFromFormat('Y-m-d\TH:i', $endDateTime);

    if (!$startDateTimeObj || !$endDateTimeObj) {
        header("Location: index.php?error=Invalid date format. Use YYYY-MM-DD HH:MM.");
        exit();
    }

    if ($endDateTimeObj <= $startDateTimeObj) {
        header("Location: index.php?error=End date/time must be after start date/time.");
        exit();
    }

    $eventId = uniqid();

    $eventLine = "$eventId|$name|$description|$startDateTime|$endDateTime" . PHP_EOL;

    $file = fopen('events.txt', 'a');
    if ($file) {
        fwrite($file, $eventLine);
        fclose($file);
        header("Location: index.php?success=Event " . urlencode($name) . " Successfully Created.");
    } else {
        header("Location: index.php?error=Failed to save event.");
    }
    header("Location: index.php?message=" . urlencode("Event $name successfully added."));
    exit;
}




