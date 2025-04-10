<?php
$events = [];
$today = new DateTime();
$today->setTime(0, 0, 0);

$weekStart = clone $today;
$weekStart->modify('Monday this week');
$weekEnd = clone $weekStart;
$weekEnd->modify('+6 days');

if (file_exists('events.txt')) {
    $file = fopen('events.txt', 'r');
    while (($line = fgetcsv($file, 1000, '|', '"', "\\")) !== false) {
        list($id, $name, $description, $startDateTime, $endDateTime) = $line;
        try {
            $event = [
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'startDateTime' => new DateTime($startDateTime),
                'endDateTime' => new DateTime($endDateTime),
            ];
            $events[] = $event;
        } catch (Exception $e) {
            error_log("Invalid date format in event ID $id: " . $e->getMessage());
            continue;
        }
    }
    fclose($file);
}

$pastEvents = [];
$thisWeekEvents = [];
$futureEvents = [];

foreach ($events as $event) {
    if ($event['endDateTime'] < $today) {
        $pastEvents[] = $event;
    } elseif ($event['startDateTime'] >= $weekStart && $event['startDateTime'] <= $weekEnd) {
        $thisWeekEvents[] = $event;
    } else {
        $futureEvents[] = $event;
    }
}

$message = $_GET['message'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmDelete(eventId) {
            if (confirm("Are you sure you want to delete this event?")) {
                window.location.href = `delete-event.php?id=${eventId}`;
            }
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200 p-6">
    <div class="container mx-auto max-w-5xl bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Event List</h1>
        </div>

        <?php if ($message): ?>
            <div class="mb-4 p-4 bg-green-500 text-white rounded text-center">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="flex justify-end mb-4">
            <a href="new-event.php" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">+ New Event</a>
        </div>

        <?php function displayEvents($events, $title) { ?>
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-300 border-b pb-2"> <?= $title ?> </h2>
                <div class="overflow-x-auto mt-3">
                    <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow">
                        <thead class="bg-gray-200 dark:bg-gray-600">
                            <tr>
                                <th class="p-3 text-left">Name</th>
                                <th class="p-3 text-left">Start Date</th>
                                <th class="p-3 text-left">End Date</th>
                                <th class="p-3 text-left">Description</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?>
                                <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <td class="p-3"> <?= htmlspecialchars($event['name']) ?> </td>
                                    <td class="p-3"> <?= $event['startDateTime']->format('Y-m-d H:i') ?> </td>
                                    <td class="p-3"> <?= $event['endDateTime']->format('Y-m-d H:i') ?> </td>
                                    <td class="p-3"> <?= htmlspecialchars($event['description']) ?> </td>
                                    <td class="p-3 flex space-x-2">
                                        <a href="edit-event.php?id=<?= $event['id'] ?>" class="px-3 py-1 bg-blue-500 dark:bg-blue-400 text-white rounded hover:bg-blue-600 dark:hover:bg-blue-500">Edit</a>
                                        <button onclick="confirmDelete('<?= $event['id'] ?>')" class="px-3 py-1 bg-red-500 dark:bg-red-400 text-white rounded hover:bg-red-600 dark:hover:bg-red-500">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>

        <?php displayEvents($pastEvents, 'Past Events'); ?>
        <?php displayEvents($thisWeekEvents, 'This Week'); ?>
        <?php displayEvents($futureEvents, 'Future Events'); ?>
    </div>
</body>
</html>
