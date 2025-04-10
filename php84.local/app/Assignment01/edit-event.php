<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid event ID.");
}

$eventId = $_GET['id'];
$eventFile = 'events.txt';
$eventData = null;

if (file_exists($eventFile)) {
    $file = fopen($eventFile, 'r');
    while (($line = fgetcsv($file, 1000, '|', '"', "\\")) !== false) {
        if ($line[0] === $eventId) {
            $eventData = $line;
            break;
        }
    }
    fclose($file);
}

if (!$eventData) {
    die("Event not found.");
}

list($id, $name, $description, $startDateTime, $endDateTime) = $eventData;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-6">
    <div class="container mx-auto max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Event</h1>


        <form action="edit-event-handler.php" method="post" class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Event Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Start Date & Time:</label>
                <input type="datetime-local" name="startDateTime" value="<?= date('Y-m-d\TH:i', strtotime($startDateTime)) ?>" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">End Date & Time:</label>
                <input type="datetime-local" name="endDateTime" value="<?= date('Y-m-d\TH:i', strtotime($endDateTime)) ?>" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description:</label>
                <textarea name="description" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required><?= htmlspecialchars($description) ?></textarea>
            </div>
            
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>
