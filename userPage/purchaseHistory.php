<?php 
include("../database/conn.php");
include("./userFunction.php");
session_start();

$user = new user($conn);
$user_id = $_SESSION['user']['user_id'];

// Pagination variables
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

// Get ticket data
$ticketsData = $user->purchase_history($user_id, $currentPage, $itemsPerPage=5);
$tickets = $ticketsData['history'];
$totalTickets = $ticketsData['total'];
$totalPages = ceil($totalTickets / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events - Purchase History</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-primary flex flex-col min-h-screen bg-gray-100">
    <?php include('../template/navbarUser.php')?>
    
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Your Purchase<span class="text-[#009332]"> History</span></h1>
                    <p class="text-gray-600">View all your ticket purchases</p>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <!-- Status Filter -->
                        <div>
                            <label for="status-filter" class="sr-only">Status</label>
                            <select id="status-filter" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Statuses</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                        
                        <!-- Date Filter -->
                        <div>
                            <label for="date-filter" class="sr-only">Date</label>
                            <select id="date-filter" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Dates</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Search -->
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

            <!-- Purchase History Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Event
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Purchase Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tickets
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (count($tickets) > 0): ?>
                                <?php foreach ($tickets as $ticket): 
                                    // Determine status and styling
                                    $status = 'completed'; // You should replace this with actual status from your data
                                    $statusClass = [
                                        'completed' => 'bg-green-100 text-green-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'refunded' => 'bg-blue-100 text-blue-800'
                                    ][$status] ?? 'bg-gray-100 text-gray-800';
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-md object-cover" 
                                                          src="/admin/upload/<?php echo htmlspecialchars($ticket['event_image']); ?>" 
                                                        alt="<?= htmlspecialchars($ticket['event_name']) ?>">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        <?= htmlspecialchars($ticket['event_name']) ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <?= date('M d, Y', strtotime($ticket['event_date'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?= date('M d, Y', strtotime($ticket['order_date'])) ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?= date('h:i A', strtotime($ticket['order_date'])) ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?= $ticket['quantity'] ?? 1 ?> Ticket<?= ($ticket['quantity'] ?? 1) > 1 ? 's' : '' ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?= htmlspecialchars($ticket['ticket_type'] ?? 'General Admission') ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₱<?= number_format($ticket['total_price'] ?? 0, 2) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                <?= ucfirst($status) ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <button class="text-[#009332] hover:text-[#007A2A] cursor-pointer view-details" 
                                                    data-ticket-id="<?= $ticket['ticket_id'] ?>"
                                                    title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <?php if ($status === 'completed'): ?>
                                                    <button class="text-blue-600 hover:text-blue-900 cursor-pointer download-ticket" 
                                                        data-ticket-id="<?= $ticket['ticket_id'] ?>"
                                                        title="Download Ticket">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="text-gray-400 cursor-not-allowed" 
                                                        title="Download unavailable" disabled>
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No ticket purchases found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium"><?= (($currentPage - 1) * $itemsPerPage) + 1 ?></span> to 
                                <span class="font-medium"><?= min($currentPage * $itemsPerPage, $totalTickets) ?></span> of 
                                <span class="font-medium"><?= $totalTickets ?></span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="?page=<?= max(1, $currentPage - 1) ?>" 
                                   class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                
                                <?php 
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                                
                                if ($startPage > 1): ?>
                                    <a href="?page=1" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        1
                                    </a>
                                    <?php if ($startPage > 2): ?>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                    <a href="?page=<?= $i ?>" 
                                       class="<?= $i == $currentPage ? 'bg-[#009332] text-white' : 'bg-white text-gray-700 hover:bg-gray-50' ?> relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                                
                                <?php if ($endPage < $totalPages): ?>
                                    <?php if ($endPage < $totalPages - 1): ?>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                            ...
                                        </span>
                                    <?php endif; ?>
                                    <a href="?page=<?= $totalPages ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <?= $totalPages ?>
                                    </a>
                                <?php endif; ?>
                                
                                <a href="?page=<?= min($totalPages, $currentPage + 1) ?>" 
                                   class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- View Details Modal (to be implemented) -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <!-- Modal content -->
    </div>

    <script>
        // View Details button functionality
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const ticketId = this.getAttribute('data-ticket-id');
                // Implement modal display with ticket details
                console.log('View details for ticket:', ticketId);
                // You would typically fetch ticket details via AJAX here
            });
        });

        // Download Ticket button functionality
        document.querySelectorAll('.download-ticket').forEach(button => {
            button.addEventListener('click', function() {
                const ticketId = this.getAttribute('data-ticket-id');
                // Implement download functionality
                console.log('Download ticket:', ticketId);
                window.location.href = `/download-ticket.php?id=${ticketId}`;
            });
        });

        // Filter functionality
        document.getElementById('status-filter').addEventListener('change', function() {
            // Implement status filter
            console.log('Filter by status:', this.value);
            // You would typically reload the page with filter parameters or use AJAX
        });

        document.getElementById('date-filter').addEventListener('change', function() {
            // Implement date filter
            console.log('Filter by date:', this.value);
        });

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            // Implement search
            console.log('Search for:', this.value);
        });
    </script>
</body>
</html>