<?php 
include("../database/conn.php");
include("./userFunction.php");
session_start();

$user = new user($conn);
$user_id = $_SESSION['user']['user_id'];
$successDeleteTicket=false;
$failedDeleteTicket=false;
// Handle delete request
if (isset($_POST['delete_ticket']) && isset($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];
    $result = $user->deleteTicket($user_id, $ticket_id);
    if ($result) {
$successDeleteTicket = true;
    } else {
               $failedDeleteTicket = true;
        $message= "Failed to delete ticket";

    }

}
include("./successDeleteTicket.php");

// Pagination variables
$itemsPerPage = 5; // Number of tickets per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Get tickets data
$ticketsData = $user->myTicket($user_id, $currentPage, $itemsPerPage);
$tickets = $ticketsData['tickets'];
$totalTickets = $ticketsData['total'];
$totalPages = ceil($totalTickets / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-primary flex flex-col min-h-screen bg-gray-100">
    <?php include('../template/navbarUser.php')?>

    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Display messages -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="mb-4 p-4 rounded-md <?php echo $_SESSION['message_type'] === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                    <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
                </div>
            <?php endif; ?>

            <!-- page Header -->
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">My <span class="text-[#009332]">Tickets</span></h1>
                <p class="text-gray-600">View and manage your event tickets</p>
            </div>

            <!-- filter Controls -->
            <div class="bg-white shadow-sm p-6 rounded-lg mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center space-x-2">
                        <label for="filter" class="text-sm font-medium text-gray-700">Filter:</label>
                        <select id="filter" class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                            <option value="all">All Tickets</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="past">Past Events</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
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

            <!-- tickets List -->
            <div class="space-y-4">
                <!-- active Ticket Card -->
                <div class="space-y-4">
                    <?php if (is_array($tickets) && count($tickets) > 0): ?>
                        <?php 
                        $currentDate = new DateTime();
                        foreach ($tickets as $ticket): 
                            $eventDate = new DateTime($ticket['event_date'] . ' ' . $ticket['event_start_time']);
                            $isUpcoming = $eventDate > $currentDate;
                        ?>
                            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border-l-4 border-[#009332]">
                                <div class="p-4 md:p-5">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center mb-1">
                                                <h3 class="font-bold text-lg text-gray-800 mr-2">
                                                    <?php echo htmlspecialchars($ticket['event_name']); ?>
                                                </h3>
                                                <?php if ($isUpcoming): ?>
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Active</span>
                                                <?php else: ?>
                                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-0.5 rounded-full">Past Event</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex flex-wrap items-center text-sm text-gray-600 gap-x-4 gap-y-1">
                                                <div class="flex items-center">
                                                    <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <span><?php echo htmlspecialchars($ticket['event_location']); ?></span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span><?php echo date('M d, Y', strtotime($ticket['event_date'])) . ' • ' . date('h:i A', strtotime($ticket['event_start_time'])); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <button class="cursor-pointer px-3 py-1.5 bg-[#009332] hover:bg-[#007A2A] text-white text-sm rounded-md transition flex items-center justify-center" data-ticket-button 
                                                data-event="<?= htmlspecialchars($ticket['event_name']) ?>"
                                                data-date="<?= $ticket['event_date'] ?>"
                                                data-day="<?= date('l', strtotime($ticket['event_date'])) ?>"
                                                data-time="<?= date('g:i A', strtotime($ticket['event_start_time'])) . ' - ' . date('g:i A', strtotime($ticket['event_end_time'])) ?>"
                                                data-location="<?= htmlspecialchars($ticket['event_location']) ?>"
                                                data-holder="<?= htmlspecialchars($ticket['full_name']) ?>"
                                                data-ticket-number="<?= htmlspecialchars($ticket['ticket_code'] ?? '') ?>"
                                                data-issue-date="<?= date('M j, Y', strtotime($ticket['order_date'])) ?>">
                                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                View Ticket
                                            </button>
                                        
                                            <?php if ($isUpcoming): ?>
                                              
                                                    <input type="hidden" name="ticket_id" value="<?= $ticket['ticket_id'] ?>">
                                                    <button type="button" name="delete_ticket" class="cursor-pointer px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm rounded-md transition flex items-center justify-center" onclick="openDeleteModal(<?= $ticket['ticket_id'] ?>)" >
                                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                               
                                            <?php endif; ?>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-600">No tickets found.</p>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-700">
                        Showing <span class="font-medium"><?php echo (($currentPage - 1) * $itemsPerPage) + 1; ?></span> 
                        to <span class="font-medium"><?php echo min($currentPage * $itemsPerPage, $totalTickets); ?></span> 
                        of <span class="font-medium"><?php echo $totalTickets; ?></span> tickets
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
        </div>
        <?php include ("./deleteTicketModal.php"); ?>
        <?php include ("./viewTicketModal.php");?>  
    </div>

    <script>
        function openDeleteModal(ticketId) {
    document.getElementById('deleteTicketId').value = ticketId;
    document.getElementById('deleteModalContainer').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModalContainer').classList.add('hidden');
}
           
       
    </script>
</body>
</html>