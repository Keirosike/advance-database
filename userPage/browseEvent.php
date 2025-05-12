<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" 
    type="image/x-icon" />
    <link rel="stylesheet" href="/src/output.css">
</head>
<body class="font-primary flex flex-col min-h-screen bg-gray-100">
    <?php include('../template/navbarUser.php')?>

    <div class="flex-1 p-4 md:p-6">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Browse <span class="text-[#009332]">Events</span> </h1>
            <p class="text-gray-600">Discover upcoming events at DNSC</p>
        </div>

        <!-- Filter and Search Controls -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="grid grid-cols-2 md:flex gap-3">
                    <!-- Category Filter -->
                    <div class="w-full md:w-auto">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select id="category" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                            <option value="all">All Categories</option>
                            <option value="academic">Academic</option>
                            <option value="sports">Sports</option>
                            <option value="cultural">Cultural</option>
                            <option value="social">Social</option>
                        </select>
                    </div>
                    
                    <!-- Date Filter -->
                    <div class="w-full md:w-auto">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <select id="date" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                            <option value="all">All Dates</option>
                            <option value="today">Today</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                        </select>
                    </div>
                    
                    <!-- Location Filter -->
                    <div class="w-full md:w-auto">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <select id="location" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                            <option value="all">All Locations</option>
                            <option value="auditorium">University Auditorium</option>
                            <option value="gym">University Gym</option>
                            <option value="ground">Main Ground</option>
                        </select>
                    </div>
                </div>
                
                <!-- Search Box -->
                <div class="w-full md:w-64">
                    <label for="search" class="sr-only">Search events</label>
                    <div class="relative">
                        <input type="text" id="search" placeholder="Search events..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#009332]">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Event Card 1 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event1.jpg" alt="University Festival" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Oct 15
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full mb-1">Cultural</span>
                            <h3 class="font-bold text-lg text-gray-800">University Festival 2023</h3>
                        </div>
                        <button class="text-gray-400 hover:text-[#009332]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Main Campus Ground</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>10:00 AM - 5:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">₱200.00</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event2.jpg" alt="Tech Symposium" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Oct 22
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-0.5 rounded-full mb-1">Academic</span>
                            <h3 class="font-bold text-lg text-gray-800">Tech Symposium</h3>
                        </div>
                        <button class="text-gray-400 hover:text-[#009332]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Engineering Building</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>9:00 AM - 4:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">Free</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </article>

            <!-- Event Card 3 -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event3.jpg" alt="Alumni Homecoming" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Nov 5
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full mb-1">Social</span>
                            <h3 class="font-bold text-lg text-gray-800">Alumni Homecoming</h3>
                        </div>
                        <button class="text-[#009332]">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>University Auditorium</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>6:00 PM - 11:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">₱500.00</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </article>

            <!-- Event Card 4 -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event4.jpg" alt="Sports Festival" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Nov 15
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full mb-1">Sports</span>
                            <h3 class="font-bold text-lg text-gray-800">Sports Festival</h3>
                        </div>
                        <button class="text-gray-400 hover:text-[#009332]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>University Gymnasium</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>8:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">₱150.00</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </article>

            <!-- Event Card 5 -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event5.jpg" alt="Research Conference" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Nov 25
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-0.5 rounded-full mb-1">Academic</span>
                            <h3 class="font-bold text-lg text-gray-800">Research Conference</h3>
                        </div>
                        <button class="text-gray-400 hover:text-[#009332]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Science Building</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>9:00 AM - 3:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">₱300.00</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </article>

            <!-- Event Card 6 -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="relative">
                    <img src="/public/image/event6.jpg" alt="Christmas Party" class="w-full h-48 object-cover" loading="lazy">
                    <div class="absolute top-3 right-3 bg-[#009332] text-white text-xs font-medium px-2 py-1 rounded-full">
                        Dec 15
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full mb-1">Social</span>
                            <h3 class="font-bold text-lg text-gray-800">Christmas Party</h3>
                        </div>
                        <button class="text-gray-400 hover:text-[#009332]">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-3">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Student Center</span>
                    </div>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>6:00 PM - 12:00 AM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-900">₱250.00</span>
                        <a href="/userPage/eventDetails.php" class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition">
                            View Details
                        </a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">6</span> of <span class="font-medium">12</span> events
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
                    Previous
                </button>
                <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium bg-[#009332] text-white">
                    1
                </button>
                <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    2
                </button>
                <button class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </button>
            </div>
        </div>
    </div>

   
</body>
</html>