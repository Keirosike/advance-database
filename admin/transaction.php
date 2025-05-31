<?php

include("../database/conn.php");
include("./adminFunction.php");
$admin = new admin($conn);

$transactions = $admin->getAllTransactions();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events - Transaction Management</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-primary bg-gray-100 min-h-screen">
   <?php include("../template/navbarAdmin.php");?>

    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header with Export Button -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Transaction <span class="text-[#009332]">History</span></h1>
                    <p class="text-gray-600">View and manage all payment transactions</p>
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
                               
                            </select>
                        </div>
                        
                        <!-- Date Range Filter -->
                        <div class="flex items-center space-x-2">
                            <input type="date" id="start-date" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                            <span>to</span>
                            <input type="date" id="end-date" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                        </div>
                    </div>
                    
                    <!-- Search -->
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search transactions..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#009332]">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                            <div class="max-h-[500px] overflow-y-auto">

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Transaction ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Event
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Time
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Method
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="transactionsTableBody">
                            
                            <!-- Transaction 1 -->
                          <?php


foreach ($transactions as $transaction) {
    // Format the date and time if needed
    $date = date('F j, Y', strtotime($transaction['event_date']));
   
    $amount = '₱' . number_format($transaction['total_price'], 2);
    $timeRange = $transaction['event_time']; // "10:00:00 - 12:00:00"

$times = explode(' - ', $timeRange);
$startTime = date('g:iA', strtotime($times[0]));
$endTime = date('g:iA', strtotime($times[1]));

$formattedTime = $startTime . ' - ' . $endTime;
    
    // Determine status color and text
    $statusClass = '';
    $statusText = '';
    switch(strtolower($transaction['status'])) {
        case 'completed':
            $statusClass = 'bg-green-100 text-green-800';
            break;
        case 'pending':
            $statusClass = 'bg-yellow-100 text-yellow-800';
            break;
        case 'failed':
            $statusClass = 'bg-red-100 text-red-800';
            break;
        default:
            $statusClass = 'bg-gray-100 text-gray-800';
    }
    $statusText = ucfirst($transaction['status']);
?>
<tr class="hover:bg-gray-50" id="transaction-row-<?php echo $transaction['purchase_id']; ?>">
    <td class="px-15  py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
        #<?php echo htmlspecialchars($transaction['purchase_id']); ?>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full object-cover" 
                   src="<?= !empty($transaction['profile_image']) ? '/userPage/upload/'.$transaction['profile_image'] : '/public/image/user.png' ?>"
                    alt="">
            </div>
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">
                    <?php echo htmlspecialchars($transaction['full_name']); ?>
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            <?php echo htmlspecialchars($transaction['event_name']); ?>
        </div>
        <div class="text-sm text-gray-500">
            <?php echo $date; ?>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
         <?= $formattedTime ?>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        <?php echo $amount; ?>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        <div class="flex items-center">
            <i class="fa-solid fa-g text-blue-500 mr-2"></i>
            <?php echo htmlspecialchars($transaction['payment_method']); ?>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusClass; ?>">
            <?php echo $statusText; ?>
        </span>
    </td>
    <td class="px-9 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex justify-center space-x-2">
           <button onclick="openTransactionDetails(this)" class="text-blue-600 hover:text-blue-900 cursor-pointer" title="View" 
    data-id="<?= htmlspecialchars($transaction['purchase_id']) ?>"
    data-user-name="<?= htmlspecialchars($transaction['full_name']) ?>"
    data-user-email="<?= htmlspecialchars($transaction['email']) ?>"
    data-user-image="<?= htmlspecialchars($transaction['profile_image'] ?? '') ?>"
    data-event="<?= htmlspecialchars($transaction['event_name']) ?>"
    data-event-date="<?= htmlspecialchars($date) ?>"
    data-order-date="<?= htmlspecialchars(date('F d, Y h:i A', strtotime($transaction['order_date']))) ?>"
    data-amount="<?= $amount ?>"
    data-payment-method="<?= htmlspecialchars($transaction['payment_method']) ?>"
    data-status="<?= htmlspecialchars($transaction['status']) ?>"
    data-receipt-url="<?= htmlspecialchars($transaction['receipt_url'] ?? '') ?>"
>
    <i class="fas fa-eye"></i>
</button>
        </div>
    </td>
</tr>
<?php
}
?>
                  
                            
                        </tbody>
                    </table>
                </div>
</div>
            
            </div>
        </div>
    </div>

   <?php include("./transactionDetailsModal.php");?>
   

   
    </body> 