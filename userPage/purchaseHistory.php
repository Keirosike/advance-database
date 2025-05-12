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
    
    <main class="flex-grow container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Purchase <span class="text-[#009332]">History</span></h1>
            
            <!-- Filter/Search Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="w-full md:w-auto">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Purchases</label>
                    <div class="relative">
                        <input type="text" id="search" placeholder="Search by event name..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-auto">
                    <label for="filter" class="block text-sm font-medium text-gray-700 mb-1">Filter by</label>
                    <select id="filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">All Purchases</option>
                        <option value="upcoming">Upcoming Events</option>
                        <option value="past">Past Events</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            
            <!-- Purchase History List -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <!-- Table Header -->
                <div class="grid grid-cols-11 bg-gray-100 px-6 py-3 text-sm font-medium text-gray-700 uppercase tracking-wider">
                    <div class="col-span-4 md:col-span-5">Event</div>
                    <div class="col-span-3 md:col-span-2">Date</div>
                    <div class="col-span-3 md:col-span-2">Price</div>
                    <div class="col-span-2 md:col-span-2">Status</div> 
                </div>
    
                <div class="grid grid-cols-11 px-6 py-4 border-b border-gray-200 hover:bg-gray-50 items-center">
                    <div class="col-span-4 md:col-span-5 flex items-center">
                        <img src="/public/image/dnscBg.png" alt="Event poster" class="w-16 h-16 object-cover rounded mr-4">
                        <div>
                            <h3 class="font-medium text-gray-900">Annual Science Symposium</h3>
                            <p class="text-sm text-gray-500">Ticket x2</p>
                        </div>
                    </div>
                    <div class="col-span-3 md:col-span-2 text-sm text-gray-900">15 Oct 2023</div>
                    <div class="col-span-3 md:col-span-2 text-sm text-gray-900">$40.00</div>
                    <div class="col-span-2 md:col-span-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                    </div>
                   
                </div>
                
             
              
    
            
   
    </main>
    

</body>
</html>