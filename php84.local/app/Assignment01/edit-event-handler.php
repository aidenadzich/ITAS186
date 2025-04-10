<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = $_POST['id'] ?? '';
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
    header("Location: index.php?message=" . urlencode("Invalid date format."));
    exit;
}

if ($endDateTimeObj <= $startDateTimeObj) {
    header("Location: index.php?message=" . urlencode("End date must be after start date."));
    exit;
}

$name = str_replace('|', '\\|', $name);
$description = str_replace('|', '\\|', $description);
$updatedEvent = "$id|$name|$description|{$startDateTimeObj->format('Y-m-d H:i:s')}|{$endDateTimeObj->format('Y-m-d H:i:s')}";

$events = file("events.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$updatedEvents = [];
$found = false;

foreach ($events as $event) {
    $eventData = explode('|', $event);
    if ($eventData[0] === $id) {
        $updatedEvents[] = $updatedEvent;
        $found = true;
    } else {
        $updatedEvents[] = $event;
    }
}

if (!$found) {
    header("Location: index.php?message=" . urlencode("Event not found."));
    exit;
}

file_put_contents("events.txt", implode("\n", $updatedEvents) . "\n");

header("Location: index.php?message=" . urlencode("Event $name successfully edited."));
exit;

