<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Create an Event</title>
		<script src="https://cdn.tailwindcss.com"></script>
	</head>

	<body>
		<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
			<div class="relative py-3 sm:max-w-xl sm:mx-auto">
				<div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
					<div class="max-w-md mx-auto">
						<div class="flex items-center space-x-5">
							<div class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">i</div>
							<div class="block pl-2 font-semibold text-xl self-start text-gray-700">
								<h2 class="leading-relaxed">Create an Event</h2>
								<p class="text-sm text-gray-500 font-normal leading-relaxed">Add an event.</p>
							</div>
						</div>
						<form class="divide-y divide-gray-200" method="POST" action="eventformhandler.php">
							<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
								<div class="flex flex-col">
									<label class="leading-loose">Event Title</label>
									<input name="title" type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Event title">
								</div>
								<div class="flex flex-col">
									<label class="leading-loose">Event Features</label>
									<div class="text-sm flex flex-col">
										<label class="inline-flex items-center mt-3">
											<input name="features[]" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="Light Refreshment"><span class="ml-2 text-gray-700">Light Refreshment</span>
										</label>
										<label class="inline-flex items-center mt-3">
											<input name="features[]" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="Exciting Games"><span class="ml-2 text-gray-700">Exciting Games</span>
										</label>
										<label class="inline-flex items-center mt-3">
											<input name="features[]" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="Prizes and Giveaways"><span class="ml-2 text-gray-700">Prizes and Giveaways</span>
										</label>
										<label class="inline-flex items-center mt-3">
											<input name="features[]" type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="Goodie Bags"><span class="ml-2 text-gray-700">Goodie Bags</span>
										</label>
									</div>
								</div>
								<div class="flex items-center space-x-4">
									<div class="flex flex-col">
										<label class="leading-loose">Start</label>
										<div class="relative focus-within:text-gray-600 text-gray-400">
											<input name="start_date" type="date" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
											<div class="absolute left-3 top-2">
												<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
												</svg>
											</div>
										</div>
									</div>
									<div class="flex flex-col">
										<label class="leading-loose">End</label>
										<div class="relative focus-within:text-gray-600 text-gray-400">
											<input name="end_date" type="date" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
											<div class="absolute left-3 top-2">
												<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
												</svg>
											</div>
										</div>
									</div>
								</div>
								<div class="flex flex-col">
									<label class="leading-loose">Event Description</label>
									<input name="description" type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="">
								</div>
							</div>
							<div class="pt-4 flex items-center space-x-4">
								<button type="reset" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
									<svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
									</svg> Clear
								</button>
								<button class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Create</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>