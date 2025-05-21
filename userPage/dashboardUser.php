<?php
session_start();

include('../database/conn.php');
include('../userPage/userFunction.php');


$user = new user($conn);
$events = $user->showEventInDashboard();




?>    
    
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DNSC Events</title>
        <meta name="description" content="DNSC Events - Your portal for university events and activities">
        <link rel="stylesheet" href="/src/output.css">
        <link rel="icon" href="/public/image/dnscLogo.png" type="image/png">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    </head>

    <style>
        .fc-toolbar .fc-button {
    font-weight: 300 !important;
}

        .fc .fc-button:focus {
        outline: none !important;
        box-shadow: none !important;
    }
        /* Change all calendar buttons */
        .fc .fc-button {
            background-color: #009332 !important; /* DNSC green */
            border-color: #009332 !important;
            color: white !important;
        
        }

        /* Hover effect */
        .fc .fc-button:hover {
            background-color: #007a29 !important;
            border-color: #007a29 !important;
        }

        /* Active (pressed) button */
        .fc .fc-button:active,
        .fc .fc-button.fc-button-active {
            background-color: #006622 !important;
            border-color: #006622 !important;
            box-shadow: none !important;
        }

        /* Disabled buttons */
        .fc .fc-button:disabled {
            background-color: #ccc !important;
            border-color: #ccc !important;
            color: #666 !important;
        }

            @media (max-width: 640px) {
        .fc .fc-toolbar {
            flex-direction: column;
        }

        .fc .fc-toolbar .fc-toolbar-chunk {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .fc .fc-button {
            font-size: 0.75rem; /* smaller font */
            padding: 0.25rem 0.5rem; /* smaller padding */
        }
    }
    </style>
    <body class="font-primary flex flex-col min-h-screen bg-gray-50">
        <?php include('../template/navbarUser.php')?> 

        <div class="flex-1 p-4 md:p-6 lg:p-8">
            <!-- Welcome Header -->
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, <span class="text-[#009332]">User</span>!</h1>
                <p class="text-gray-600">Here's what's happening with your events today</p>
</div>

     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
    <!-- Ticket Purchases -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Ticket Purchases</h3>
                <p class="text-2xl font-bold text-indigo-600">24</p>
                <p class="text-xs text-gray-400 mt-2 flex items-center">
               
                   
                </p>
            </div>
            <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Spent -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Total Spent</h3>
                <p class="text-2xl font-bold text-rose-600">$1,845</p>
                <p class="text-xs text-gray-400 mt-2 flex items-center">
                 
              
                </p>
            </div>
            <div class="p-3 rounded-lg bg-rose-50 text-rose-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Events Attended -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Events Attended</h3>
                <p class="text-2xl font-bold text-emerald-600">18</p>
                <p class="text-xs text-gray-400 mt-2 fle`x items-center">
                   
          
                </p>
            </div>
            <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Pending Payments -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-gray-500 text-sm font-medium mb-1">Pending Payments</h3>
                <p class="text-2xl font-bold text-amber-600">$420</p>
                <p class="text-xs text-gray-400 mt-2 flex items-center">
                  
               
                </p>
            </div>
            <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>
            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-4">
            

                <!-- Upcoming Events -->
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Upcoming Events</h2>
                    <div class="space-y-4 cursor-pointer">
                        <?php foreach ($events as $event): ?>
                            <?php
                            $date = new DateTime($event['event_date']);
                            $month = strtoupper($date->format('M'));
                            $day = $date->format('d');
                            
                            ?>
               <div
  class="event-card flex items-start gap-3 p-2 hover:bg-gray-50 rounded transition view-details-btn"
  data-event-id="<?= $event['event_id'] ?>"
  data-event-name="<?= htmlspecialchars($event['event_name']) ?>"
  data-event-type="<?= htmlspecialchars($event['event_type']) ?>"
  data-event-location="<?= htmlspecialchars($event['event_location']) ?>"
  data-event-date="<?= $event['event_date'] ?>"
  data-start-time="<?= date('g:i A', strtotime($event['event_start_time'])) ?>"
  data-end-time="<?= date('g:i A', strtotime($event['event_end_time'])) ?>"
  data-ticket-price="<?= $event['ticket_price'] == 0 ? 'Free' : '₱' . number_format($event['ticket_price'], 2) ?>"
  data-description="<?= htmlspecialchars($event['event_description'] ?? 'No description available') ?>"
  data-event-image="<?= htmlspecialchars('/admin/upload/'.$event['event_image']) ?>"
>
                <div class="bg-[#009332] text-white text-xs font-bold px-2 py-1 rounded min-w-[60px] text-center">
                    <p><?= $month ?></p>
                    <p class="text-lg"><?= $day ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800"><?= htmlspecialchars($event['event_name']) ?></h3>
                    <p class="text-sm text-gray-500"><?= date('g:i A', strtotime($event['event_start_time'])) ?> - <?= date('g:i A', strtotime($event['event_end_time'])) ?></p>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($event['event_location']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    

                           
                    </div>
                    <a href="/userPage/browseEvent.php" class="block mt-4 text-[#009332] text-sm font-medium hover:underline text-center">View all events</a>
                </div>
        
            <!-- Recent Purchases -->
        <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Purchases</h2>
        <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" >
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">University Foundation Day</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">May 25, 2023</td>
                
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱150.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Research Colloquium</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 2, 2023</td>
                
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱50.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sports Fest Opening</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 15, 2023</td>
                        
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">₱75.00</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="/userPage/purchaseHistory.php" class="block mt-4 text-[#009332] text-sm font-medium hover:underline text-center">View all purchases</a>
                </div>
            
            </div>
            </div>


                <div class=" bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Event Calendar</h2>
                    <div id="calendar" class="h-full"></div>
                </div>
                        </div>

                        <?php include('../template/userModal/viewDetailsDashboard.php')?>

        <!-- Calendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    showNonCurrentDates: false,
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    }
                   
                });
                calendar.render();
            });

            
        </script>
    </body>
    </html>