<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?error=" . urlencode("Missing event ID."));
    exit;
}

$eventId = $_GET['id'];
$eventFile = 'events.txt';
$tempFile = 'events_temp.txt';
$deleted = false;

if (($input = fopen($eventFile, 'r')) && ($output = fopen($tempFile, 'w'))) {
    while (($line = fgets($input)) !== false) {
        $eventData = explode('|', trim($line));
        
        if (!empty($eventData[0]) && $eventData[0] === $eventId) {
            $deleted = true;
            continue;
        }
        
        fwrite($output, $line);
    }
    fclose($input);
    fclose($output);
    
    if ($deleted) {
        rename($tempFile, $eventFile);
        header("Location: index.php?success=" . urlencode("Event successfully deleted."));
    } else {
        unlink($tempFile);
        header("Location: index.php?error=" . urlencode("Event not found."));
    }
} else {
    header("Location: index.php?error=" . urlencode("Failed to open event file."));
}
header("Location: index.php?message=" . urlencode("Event successfully deleted."));
exit;
?>

