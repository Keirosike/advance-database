<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" >
</head>
<body class="font-primary flex flex-col min-h-screen bg-gray-100">
    <?php include('../template/navbarUser.php')?> 

    <div class="flex-1 p-4 md:p-6">
        <!-- Welcome Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, <span class="text-[#009332]">User</span>!</h1>
            <p class="text-gray-600">Here's what's happening with your events today</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <!-- Card Component -->
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 md:p-3 rounded-full bg-green-100 mr-3 md:mr-4">
                        <svg class="h-5 w-5 md:h-6 md:w-6 text-[#009332]" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm text-gray-500">Upcoming Events</p>
                        <h3 class="text-xl md:text-2xl font-bold">5</h3>
                    </div>
                </div>
            </div>


            <!-- Active Tickets -->
            <article class="bg-white p-4 md:p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 md:p-3 rounded-full bg-blue-100 mr-3 md:mr-4">
                        <svg class="h-5 w-5 md:h-6 md:w-6 text-blue-500" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm text-gray-500">Active Tickets</p>
                        <h3 class="text-xl md:text-2xl font-bold">12</h3>
                    </div>
                </div>
            </article>

            <!-- Recent Purchases -->
            <article class="bg-white p-4 md:p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 md:p-3 rounded-full bg-purple-100 mr-3 md:mr-4">
                        <svg class="h-5 w-5 md:h-6 md:w-6 text-purple-500" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm text-gray-500">Recent Purchases</p>
                        <h3 class="text-xl md:text-2xl font-bold">3</h3>
                    </div>
                </div>
            </article>

            <!-- Saved Events -->
            <article class="bg-white p-4 md:p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="p-2 md:p-3 rounded-full bg-yellow-100 mr-3 md:mr-4">
                        <svg class="h-5 w-5 md:h-6 md:w-6 text-yellow-500" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm text-gray-500">Saved Events</p>
                        <h3 class="text-xl md:text-2xl font-bold">7</h3>
                    </div>
                </div>
            </article>
        </div>

        <!-- Upcoming Events Section -->
        <div class="mb-6 md:mb-8">
            <div class="flex justify-between items-center mb-3 md:mb-4">
                <h2 class="text-lg md:text-xl font-bold text-gray-800">Upcoming Events</h2>
                <a href="/userPage/browseEvent.php" class="text-xs md:text-sm text-[#009332] hover:underline focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 rounded">View All</a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                
                <!-- Event Card Component -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <img src="/public/image/dnscBg.png" alt="University Festival" class="w-full h-60 md:h-80 object-cover" loading="lazy">
                    <div class="p-3 md:p-4">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-base md:text-lg">Kalibuang 2025 Dance Competition</h3>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Upcoming</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-2 md:mb-3">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>DNSC Gymnasium</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Feb 14, 2025 • 10:00 AM</span>
                        </div>
                        <a href="/userPage/eventDetails.php" class="block w-full bg-[#009332] hover:bg-[#007A2A] text-white text-center py-1 md:py-2 rounded-md md:rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
                            View Details
                        </a>
                    </div>
                </div>

                <!-- Repeat for other event cards -->
                <!-- Event Card 2 -->
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <img src="/public/image/dnscBg.png" alt="University Festival" class="w-full h-60 md:h-80 object-cover" loading="lazy">
                    <div class="p-3 md:p-4">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-base md:text-lg">Kalibuang 2025 Dance Competition</h3>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Upcoming</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-2 md:mb-3">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>DNSC Gymnasium</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Feb 14, 2025 • 10:00 AM - 12:00 PM</span>
                        </div>
                        <a href="/userPage/eventDetails.php" class="block w-full bg-[#009332] hover:bg-[#007A2A] text-white text-center py-1 md:py-2 rounded-md md:rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
                            View Details
                        </a>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <img src="/public/image/dnscBg.png" alt="University Festival" class="w-full h-60 md:h-80 object-cover" loading="lazy">
                    <div class="p-3 md:p-4">
                        <div class="flex justify-between items-start mb-1 md:mb-2">
                            <h3 class="font-bold text-base md:text-lg">Kalibuang 2025 Dance Competition</h3>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Upcoming</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-2 md:mb-3">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>DNSC Gymnasium</span>
                        </div>
                        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
                            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Feb 14, 2025 • 10:00 AM</span>
                        </div>
                        <a href="/userPage/eventDetails.php" class="block w-full bg-[#009332] hover:bg-[#007A2A] text-white text-center py-1 md:py-2 rounded-md md:rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
                            View Details
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Recent Activity Section -->
        <section>
            <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-3 md:mb-4">Recent Activity</h2>
            <div class="bg-white rounded-lg md:rounded-xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- Activity Item Component -->
                    <article class="p-3 md:p-4 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div class="p-1 md:p-2 rounded-full bg-blue-100 mr-3 md:mr-4">
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-blue-500" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm md:text-base font-medium truncate">
                                    You purchased a ticket for <span class="text-[#009332]">Tech Symposium</span>
                                </p>
                                <p class="text-xs md:text-sm text-gray-500">2 hours ago</p>
                            </div>
                            <a href="/userPage/myTicket.php" class="text-xs md:text-sm text-[#009332] hover:underline focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 rounded ml-2">
                                View Ticket
                            </a>
                        </div>
                    </article>

                    <!-- Repeat for other activity items -->
                    <!-- Activity Item 2 -->
                    <article class="p-3 md:p-4 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div class="p-1 md:p-2 rounded-full bg-green-100 mr-3 md:mr-4">
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-[#009332]" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm md:text-base font-medium truncate">
                                    You saved <span class="text-[#009332]">Alumni Homecoming</span> to your favorites
                                </p>
                                <p class="text-xs md:text-sm text-gray-500">1 day ago</p>
                            </div>
                            <a href="/userPage/browseEvent.php" class="text-xs md:text-sm text-[#009332] hover:underline focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 rounded ml-2">
                                View Event
                            </a>
                        </div>
                    </article>

                    <!-- Activity Item 3 -->
                    <article class="p-3 md:p-4 hover:bg-gray-50 transition">
                        <div class="flex items-start">
                            <div class="p-1 md:p-2 rounded-full bg-purple-100 mr-3 md:mr-4">
                                <svg class="h-4 w-4 md:h-5 md:w-5 text-purple-500" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm md:text-base font-medium truncate">
                                    You checked in to <span class="text-[#009332]">Campus Tour</span>
                                </p>
                                <p class="text-xs md:text-sm text-gray-500">3 days ago</p>
                            </div>
                            <a href="/userPage/purchaseHistory.php" class="text-xs md:text-sm text-[#009332] hover:underline focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 rounded ml-2">
                                View History
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>


</body>
</html>