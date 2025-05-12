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
        <!-- page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My <span class="text-[#009332]">Tickets</span></h1>
            <p class="text-gray-600">View and manage your event tickets</p>
        </div>

        <!-- filter Controls -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div class="flex items-center space-x-2">
                <label for="filter" class="text-sm font-medium text-gray-700">Filter:</label>
                <select id="filter" class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                    <option value="all">All Tickets</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="past">Past Events</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="relative w-full sm:w-64">
                <input type="text" placeholder="Search tickets..." class="w-full pl-8 pr-4 py-1 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#009332]">
                <svg class="absolute left-2.5 top-2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- tickets List -->
        <div class="space-y-4">
            <!-- active Ticket Card -->
            <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border-l-4 border-[#009332]">
                <div class="p-4 md:p-5">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center mb-1">
                    <h3 class="font-bold text-lg text-gray-800 mr-2">University Festival 2023</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Active</span>
                        </div>
                            <div class="flex flex-wrap items-center text-sm text-gray-600 gap-x-4 gap-y-1">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Main Campus Ground</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Oct 15, 2023 • 10:00 AM</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button class="px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition flex items-center justify-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                View Ticket
                            </button>
                            <button class="px-3 py-1.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm rounded-md transition flex items-center justify-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                    

                    