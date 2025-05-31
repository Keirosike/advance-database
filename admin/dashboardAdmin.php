<?php

include("../database/conn.php");
include("./adminFunction.php");

$admin = new admin($conn);



$transactions = $admin->getRecentTransactions(); 



$events = $admin->showEventInDashboard();


$totalEvents = $admin->getTotalEvents();
$totalRevenue = $admin->getTotalRevenue();
$activeUsers = $admin->getActiveUsers();
$pendingApprovals = $admin->getPendingApprovals();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events - Dashboard</title>
    <meta name="description" content="Admin Dashboard - Manage university events and activities">
<link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        .fc-toolbar .fc-button {
            font-weight: 300 !important;
        }
        .fc .fc-button:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        .fc .fc-button {
            background-color: #009332 !important;
            border-color: #009332 !important;
            color: white !important;
        }
        .fc .fc-button:hover {
            background-color: #007a29 !important;
            border-color: #007a29 !important;
        }
        .fc .fc-button:active,
        .fc .fc-button.fc-button-active {
            background-color: #006622 !important;
            border-color: #006622 !important;
            box-shadow: none !important;
        }
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
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</head>
<body class=" flex flex-col min-h-screen bg-gray-50 font-primary">
   
<?php include("../template/navbarAdmin.php");?>

    <div class="flex-1 p-4 md:p-6 lg:p-8">
        <!-- Welcome Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Admin <span class="text-[#009332]">Dashboard</span></h1>
            <p class="text-gray-600">Overview of system activities and statistics</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
            <!-- Total Events -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Events</h3>
                        <p class="text-2xl font-bold text-indigo-600"><?= htmlspecialchars($totalEvents) ?></p>
                       
                    </div>
                    <div class="p-3 rounded-lg bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Revenue</h3>
                        <p class="text-2xl font-bold text-rose-600">₱<?= number_format($totalRevenue, 2) ?></p>
                   
                    </div>
                    <div class="p-3 rounded-lg bg-rose-50 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Active Users</h3>
                        <p class="text-2xl font-bold text-emerald-600"><?= htmlspecialchars($activeUsers) ?></p>
               
                    </div>
                    <div class="p-3 rounded-lg bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Pending Payments</h3>
                        <p class="text-2xl font-bold text-amber-600"><?= htmlspecialchars($pendingApprovals ?? 0) ?></p>
                  
                    </div>
                    <div class="p-3 rounded-lg bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-4">
            <!-- Recent Events -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Events</h2>
                    <a href="/admin/event.php" class="text-sm text-[#009332] font-medium hover:underline">View all</a>
                </div>
                <div class="space-y-4">
                    <!-- Event 1 -->
                  <?php foreach ($events as $event): ?>
                            <?php
                            $date = new DateTime($event['event_date']);
                            $month = strtoupper($date->format('M'));
                            $day = $date->format('d');
                            
                            ?>
               <a href="./event.php" class="event-card flex items-start gap-3 p-2 hover:bg-gray-50 rounded transition view-details-btn cursor-pointer" >
                <div class="bg-[#009332] text-white text-xs font-bold px-2 py-1 rounded min-w-[60px] text-center">
                    <p><?= $month ?></p>
                    <p class="text-lg"><?= $day ?></p>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800"><?= htmlspecialchars($event['event_name']) ?></h3>
                    <p class="text-sm text-gray-500"><?= date('g:i A', strtotime($event['event_start_time'])) ?> - <?= date('g:i A', strtotime($event['event_end_time'])) ?></p>
                    <p class="text-sm text-gray-500"><?= htmlspecialchars($event['event_location']) ?></p>
                </div>
            </a>
        <?php endforeach; ?>
                
                </div>
            </div>
            
            <!-- Recent Transactions -->
            <div class="lg:col-span-2 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Recent Transactions</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Transaction 1 -->
                        <?php

foreach ($transactions as $transaction) {
    // Format date and price
    $formattedDate = date("M d, Y", strtotime($transaction['order_date']));
    $formattedPrice = "₱" . number_format($transaction['total_price'], 2);
    
    // Optional: Badge color by status
    $statusColor = match (strtolower($transaction['status'])) {
        'completed' => 'bg-green-100 text-green-800',
        'pending' => 'bg-yellow-100 text-yellow-800',
        'cancelled' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };

    echo "<tr>
        <td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>#{$transaction['purchase_id']}</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$transaction['full_name']}</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$transaction['event_name']}</td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$formattedPrice}</td>
        <td class='px-6 py-4 whitespace-nowrap'>
            <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {$statusColor}'>
                {$transaction['status']}
            </span>
        </td>
        <td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>{$formattedDate}</td>
    </tr>";
}
?>

                        
                        </tbody>
                    </table>
                     <a href="./transaction.php" class="block mt-4 text-[#009332] text-sm font-medium hover:underline text-center">View all transaction</a>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Event Calendar</h2>
            </div>
            <div id="calendar" class="h-full"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">&copy; 2025 DNSC Event Ticketing Management System. All rights reserved.</p>
        </div>
    </footer>

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
                },
     
            });
            calendar.render();
        });
    </script>
</body>
</html>