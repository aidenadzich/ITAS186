<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-6">
    <div class="container mx-auto max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Create New Event</h1>

        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-200 p-4 rounded mb-4 text-center">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="bg-red-200 dark:bg-red-700 text-red-800 dark:text-red-200 p-4 rounded mb-4 text-center">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <form action="new-event-handler.php" method="post" class="bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Event Name:</label>
                <input type="text" name="name" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Start Date & Time:</label>
                <input type="datetime-local" name="startDateTime" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">End Date & Time:</label>
                <input type="datetime-local" name="endDateTime" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Description (Optional):</label>
                <textarea name="description" class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">Create Event</button>
            </div>
        </form>
    </div>
</body>
</html>
