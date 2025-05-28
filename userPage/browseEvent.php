    <?php 
    include('../database/conn.php');
    include('../userPage/userFunction.php');
    session_start();

    $user = new user($conn);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = 8; 

    $events = $user->showEvent($currentPage, $perPage);
    $totalEvents = $user->countEvents();
    $totalPages = ceil($totalEvents / $perPage);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DNSC Events</title>
        <link rel="icon" href="/public/image/dnscLogo.png"
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
                            <label for="eventType" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="eventType" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Categories</option>
                                <option value="Theatre">Theatre</option>
                                <option value="Movie">Movie</option>
                                <option value="Sing and Dance   ">Sing and Dance</option>
                                <option value="Sports">Sports</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Conference">Conference</option>
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
                            <label for="eventLocation" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <select id="eventlocation" class="w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Locations</option>
                                <option value="DNSC Sports Complex">DNSC Sports Complex</option>
                                <option value="DNSC Gymnasium">DNSC Gymnasium</option>
                                <option value="DNSC Covered Court">DNSC Covered Court</option>
                                <option value="DNSC AB 3-4">DNSC AB 3-4</option>
                                <option value="DNSC Music Room">DNSC Music Room</option>
                            </select>
                            </select>
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
        <!-- Events Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="events-container">
        <?php
        if ($events && count($events) > 0) {
            foreach ($events as $event) {
                $eventDate = date('M d, Y', strtotime($event['event_date']));
                $startTime = date('g:i A', strtotime($event['event_start_time']));
                $endTime = date('g:i A', strtotime($event['event_end_time']));
                $eventDateTime = strtotime($event['event_date'] . ' ' . $event['event_start_time']);
                
                $eventName = htmlspecialchars($event['event_name']);
                $eventType = htmlspecialchars($event['event_type']);
                $eventLocation = htmlspecialchars($event['event_location']);
                $ticketPrice = $event['ticket_price'] == 0 ? "Free" : "₱" . number_format($event['ticket_price'], 2);
                $eventImage = htmlspecialchars($event['event_image']);
                $eventId = (int)$event['event_id'];
                $eventDescription = htmlspecialchars($event['event_description'] ?? 'No description available');
                
                // Determine if event is past
                $isPast = time() > $eventDateTime;
                $statusClass = $isPast ? "bg-gray-100 text-gray-800" : "bg-green-100 text-green-800";
        ?>
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden event-card"
            data-category="<?php echo $eventType; ?>"
            data-location="<?php echo $eventLocation; ?>"
            data-date="<?php echo date('Y-m-d', strtotime($event['event_date'])); ?>"
            data-start-time="<?php echo $startTime; ?>"
            data-end-time="<?php echo $endTime; ?>"
            data-search="<?php echo strtolower($eventName . ' ' . $eventType . ' ' . $eventLocation); ?>"
            data-description="<?php echo $eventDescription; ?>"
            >
            
            <img src="/admin/upload/<?php echo $eventImage; ?>" 
                alt="<?php echo $eventName; ?>" 
                class="w-full h-60 md:h-80 object-cover" 
                loading="lazy">
            <div class="p-3 md:p-4">
                <div class="flex justify-between items-start mb-1 md:mb-2">
                    <h3 class="font-bold text-base md:text-lg"><?php echo $eventName; ?></h3>
                    <span class="<?php echo $statusClass; ?> text-xs px-2 py-1 rounded-full event-type  ">
                        <?php echo $eventType; ?>
                    </span>
                </div>
                <div class="flex items-center text-gray-600 text-xs md:text-sm mb-2 md:mb-3">
                    <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="event-location"><?php echo $eventLocation; ?></span>
                </div>
                <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
                    <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="event-date"><?php echo $eventDate; ?></span> <span class="separator">&nbsp; • &nbsp; </span> <span> <?php echo $startTime; ?> </span>
                </div>
                <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
                    <span><?php echo $ticketPrice; ?></span>
                </div>
            
                <button 
        class="block w-full bg-[#009332] hover:bg-[#007A2A] text-white text-center py-1 md:py-2 rounded-md md:rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 view-details-btn cursor-pointer"
        data-event-id="<?php echo $eventId; ?>">
        View Details
    </button>


            </div>
        </div>
        <?php
            }
        } else {
            echo '<div class="col-span-full text-center py-8 text-gray-500">No events found.</div>';
        }
        ?>
    </div>

            
        <!-- Pagination -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium"><?php echo (($currentPage - 1) * $perPage) + 1; ?></span> 
                    to <span class="font-medium"><?php echo min($currentPage * $perPage, $totalEvents); ?></span> 
                    of <span class="font-medium"><?php echo $totalEvents; ?></span> events
                </div>
                <div class="flex space-x-2">
                    <a href="?page=<?php echo max(1, $currentPage - 1); ?>" 
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 <?php echo $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                        Previous
                    </a>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" 
                        class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium <?php echo $i == $currentPage ? 'bg-[#009332] text-white' : 'text-gray-700 bg-white hover:bg-gray-50'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                    
                    <a href="?page=<?php echo min($totalPages, $currentPage + 1); ?>" 
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 <?php echo $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : ''; ?>">
                        Next
                    </a>
                </div>
            </div>
        </div>

        <?php include('../template/userModal/viewDetails.php')?>

        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('eventType');
        const dateFilter = document.getElementById('date');
        const locationFilter = document.getElementById('eventlocation');
        const searchInput = document.getElementById('search');
        const eventsContainer = document.getElementById('events-container');
        
        function filterEvents() {
            const categoryValue = categoryFilter.value;
            const dateValue = dateFilter.value;
            const locationValue = locationFilter.value;
            const searchValue = searchInput.value.toLowerCase();
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            const eventCards = eventsContainer.querySelectorAll('.event-card');
            let hasVisibleCards = false;
            
            eventCards.forEach(card => {
                const cardCategory = card.dataset.category;
                const cardLocation = card.dataset.location;
                const cardDate = new Date(card.dataset.date);
                const cardSearch = card.dataset.search;
                
                // Category filter
                const categoryMatch = categoryValue === 'all' || cardCategory === categoryValue;
                
                // Date filter
                let dateMatch = true;
                if (dateValue !== 'all') {
                    if (dateValue === 'today') {
                        dateMatch = cardDate.toDateString() === today.toDateString();
                    } else if (dateValue === 'week') {
                        const nextWeek = new Date(today);
                        nextWeek.setDate(today.getDate() + 7);
                        dateMatch = cardDate >= today && cardDate <= nextWeek;
                    } else if (dateValue === 'month') {
                        const nextMonth = new Date(today);
                        nextMonth.setMonth(today.getMonth() + 1);
                        dateMatch = cardDate >= today && cardDate <= nextMonth;
                    }
                }
                
                // Location filter
                const locationMatch = locationValue === 'all' || cardLocation === locationValue;
                
                // Search filter
                const searchMatch = searchValue === '' || cardSearch.includes(searchValue);
                
                // Show/hide card based on all filters
                if (categoryMatch && dateMatch && locationMatch && searchMatch) {
                    card.style.display = 'block';
                    hasVisibleCards = true;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show "no results" message if no cards are visible
            const noResultsMessage = eventsContainer.querySelector('.no-results-message');
            if (!hasVisibleCards) {
                if (!noResultsMessage) {
                    const message = document.createElement('div');
                    message.className = 'col-span-full text-center py-8 text-gray-500 no-results-message';
                    message.textContent = 'No events match your filters.';
                    eventsContainer.appendChild(message);
                }
            } else if (noResultsMessage) {
                noResultsMessage.remove();
            }
        }
        
        // Add event listeners
        categoryFilter.addEventListener('change', filterEvents);
        dateFilter.addEventListener('change', filterEvents);
        locationFilter.addEventListener('change', filterEvents);
        searchInput.addEventListener('input', filterEvents);
        
        // Initial filter
        filterEvents();
    });
    </script>
    </body>
    </html>