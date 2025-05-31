            <?php 
            include('../database/conn.php');
            session_start();
            require_once('../admin/adminFunction.php');

            $admin = new admin($conn);

            $successEvent = false;
            $failedEvent = false;
            $message = '';
            $successEditEvent = false;
            $failedEditEvent = false;


   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editEventBtn'])) {
        $result = $admin->editEvent($_POST, $_FILES);
        if ($result['success']) {
            $successEditEvent = true;
        } else {
            $failedEditEvent = true;
        }
        $message = $result['message'];
        include('../template/successEditEvent.php');
    } 
    elseif (isset($_POST['createEventBtn'])) {
        $result = $admin->createEvent($_POST, $_FILES);
        if ($result['success']) {
            $successEvent = true;
        } else {
            $failedEvent = true;
        }
        $message = $result['message'];
        include('../template/successEvent.php');
    }
    elseif (isset($_POST['deleteEventBtn'])) {
        $successDeleteEvent = false;
        $failedDeleteEvent = false;
        $message = '';

        if (!empty($_POST['eventIdToDelete'])) {
            $eventId = (int)$_POST['eventIdToDelete'];
            $deleteResult = $admin->deleteEvent($eventId);

            if ($deleteResult === true) {
                $successDeleteEvent = true;
                $message = "Event deleted successfully.";
            } else {
                $failedDeleteEvent = true;
                $message = "Failed to delete event.";
            }
        } else {
            $failedDeleteEvent = true;
            $message = "No event selected for deletion.";
        }

        include('../template/deleteEventLog.php');
    }
}


            // Pagination settings
            $rowsPerPage = 5;
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $offset = ($page - 1) * $rowsPerPage;

            // Fetch paginated events
            $stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date DESC LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', $rowsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get total count for pagination
            $totalStmt = $conn->query("SELECT COUNT(*) FROM events");
            $totalEvents = $totalStmt->fetchColumn();
            $totalPages = ceil($totalEvents / $rowsPerPage);


            


            

            


            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>DNSC Events</title>
                <link rel="stylesheet" href="/src/output.css">
                <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" type="image/x-icon" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            </head>
            <body class="font-primary bg-gray-100 min-h-screen">
                <!-- Admin Navbar -->
                <?php include('../template/navbarAdmin.php') ?>

                <?php include('../template/adminModal/modalCreateEvent.php')?>
                <?php include('../template/adminModal/modalEditEvent.php')?>

                <div class="p-6">
                    <div class="max-w-7xl mx-auto">
                        <!-- Header with Create Button -->
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manage <span class="text-[#009332]">Events</span> </h1>
                                <p class="text-gray-600">View and manage all events</p>
                            </div>
                            <button onclick="openCreateEventModal()" class="px-4 py-2 bg-[#009332] hover:bg-[#007A2A] text-white rounded-md flex items-center cursor-pointer">
                                <i class="fas fa-plus mr-2"></i> Create Event
                            </button>
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
                                            <option value="upcoming">Upcoming</option>
                                            <option value="ongoing">Ongoing</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
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
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Search -->
                                <div class="relative w-full md:w-64">
                                    <input type="text" placeholder="Search events..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Event Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date & Time
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Location
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tickets
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="eventsTableBody">
                                        <?php foreach ($events as $event): ?>
                                            <?php
                                                // Calculate status based on date
                                                $currentDate = new DateTime();
                                                $eventDate = new DateTime($event['event_date'] . ' ' . $event['event_end_time']);
                                                $status = ($eventDate > $currentDate) ? 'Upcoming' : 'Completed';
                                                $statusClass = ($status === 'Upcoming') ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                                                
                                                // Calculate ticket percentage (assuming you have a way to get tickets sold)
                                                    $ticketsSold = $event['tickets_sold'];
                                                    $ticketPercentage = ($event['ticket_quantity'] > 0) ? ($ticketsSold / $event['ticket_quantity']) * 100 : 0;
                                                    $revenue = $ticketsSold * $event['ticket_price'];
                                            ?>
                                            <tr class="hover:bg-gray-50" id="event-row-<?= $event['event_id'] ?>">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-md object-cover" 
                                                                src="upload/<?= htmlspecialchars($event['event_image']) ?>" 
                                                                alt="<?= htmlspecialchars($event['event_name']) ?>">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <?= htmlspecialchars($event['event_name']) ?>
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusClass ?>">
                                                                    <?= $status ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        <?= date('M j, Y', strtotime($event['event_date'])) ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <?= date('g:i A', strtotime($event['event_start_time'])) ?> - 
                                                        <?= date('g:i A', strtotime($event['event_end_time'])) ?>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?= htmlspecialchars($event['event_type']) ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <?= htmlspecialchars($event['event_location']) ?>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        <?= $ticketsSold ?>/<?= $event['ticket_quantity'] ?> sold
                                                    </div>
                                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                                        <div class="bg-[#009332] h-1.5 rounded-full" style="width: <?= $ticketPercentage ?>%"></div>
                                                    </div>
                                                </td>
                                                <td class="px-9 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end space-x-2">
                                                        <button onclick="openEditEventModal(<?= $event['event_id'] ?>)" class="text-blue-600 hover:text-blue-900 cursor-pointer" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                        </button>
                                            
                                                        </a>
                                                        <button class="text-red-600 hover:text-red-900 cursor-pointer" title="Delete" 
                                                                onclick="confirmDelete(<?= $event['event_id'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        <!-- Pagination -->
                        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing <span class="font-medium"><?= ($offset + 1) ?></span> to <span class="font-medium"><?= min($offset + $rowsPerPage, $totalEvents) ?></span> of <span class="font-medium"><?= $totalEvents ?></span> results
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                        <a href="?page=<?= max(1, $page - 1) ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $page <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                            <span class="sr-only">Previous</span>
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                        
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'bg-[#009332] text-white' : 'bg-white text-gray-500 hover:bg-gray-50' ?> relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium">
                                                <?= $i ?>
                                            </a>
                                        <?php endfor; ?>
                                        
                                        <a href="?page=<?= min($totalPages, $page + 1) ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 <?= $page >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>">
                                            <span class="sr-only">Next</span>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php include('../template/adminModal/deleteConfirmation.php')?>

            <script>
                let eventIdToDelete = null;

                // Delete confirmation modal
                let currentEventId = null;
                
            function confirmDelete(eventId) {
                currentEventId = eventId;
                document.getElementById('deleteEventId').value = eventId; // Set the hidden input value
                document.getElementById('deleteModal').classList.remove('hidden');
        }
                
                function closeDeleteModal() {
                    document.getElementById('deleteModal').classList.add('hidden');
                    currentEventId = null;
                }
                
                document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                    if (currentEventId) {
                        // Perform delete action here
                        console.log('Deleting event with ID:', currentEventId);
                   
                        alert(`Event ${currentEventId} would be deleted in a real application`);
                        closeDeleteModal();
                    }
                });

                // Filter functionality
                document.getElementById('status-filter').addEventListener('change', function() {
                    console.log('Filtering by status:', this.value);
                    // Implement filtering logic here
                });

                document.getElementById('date-filter').addEventListener('change', function() {
                    console.log('Filtering by date:', this.value);
                    // Implement filtering logic here
                });

                function openCreateEventModal(){
                    document.getElementById('createEventModal').classList.remove('hidden');
                }

                // AJAX Pagination (optional enhancement)
                function loadPage(page) {
                    fetch(`/admin/events?page=${page}`)
                        .then(response => response.text())
                        .then(html => {
                            // Parse the HTML and update only the table body
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTableBody = doc.getElementById('eventsTableBody');
                            document.getElementById('eventsTableBody').innerHTML = newTableBody.innerHTML;
                            
                            // Update URL without reloading
                            window.history.pushState({}, '', `?page=${page}`);
                        });
                }

                // Add event listeners to pagination links to use AJAX
                document.querySelectorAll('.pagination a').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const page = this.getAttribute('href').split('=')[1];
                        loadPage(page);
                    });
                });

            
        
            </script>
        </body>
        </html>