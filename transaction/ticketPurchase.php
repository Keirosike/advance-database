<?php
session_start();
include("../database/conn.php");
include("./transactionFunction.php");

$failedTransaction = false;
$successTransaction = false;
$message = "";

// 1. Handle event selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id']) && !isset($_POST['confirmPurchaseBtn'])) {
    $event_id = $_POST['event_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
        $stmt->execute([$event_id]);    
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            $_SESSION['selected_event'] = $event;
        } else {
            $failedTransaction = true;
            $message = "Event not found.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit;
    }
}

// 2. Handle purchase confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmPurchaseBtn'])) {
    $user_id = $_SESSION['user']['user_id'] ?? null;
    $selected_event = $_SESSION['selected_event'] ?? null;
    $quantity = 1; // Fixed quantity of 1
    $payment_method = $_POST['payment_method'] ?? 'GCash';

    if (!$user_id) {
        $failedTransaction = true;
        $message = "User not logged in.";
    }

    if (!$selected_event) {
        $failedTransaction = true;
        $message = "No event selected.";
    }

    $event_id = $selected_event['event_id'];
    $price_per_ticket = $selected_event['ticket_price'];
 
    $transaction = new Transaction($conn);
    $success = $transaction->purchaseTicket($user_id, $event_id, $quantity, $price_per_ticket, $payment_method);

    if ($success) {
        $successTransaction = true;
        include("./successTransaction.php");
    } else {
        $failedTransaction = true;
        $message = "Failed to record purchase. Please try again.";
        include("./successTransaction.php");
    }
}

$selected_event = $_SESSION['selected_event'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events-Ticket Purchase</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="/public/image/dnscLogo.png" type="image/x-icon" />
</head>
<body class="bg-gray-50 font-primary">
    <?php include("../template/navbarUser.php");?>
    
    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Ticket Selection -->
            <div class="lg:w-2/3">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Select <span class="text-[#009332]">Tickets</span></h1>
                
                <!-- Event Summary -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if ($selected_event): ?>
                            <img src="/admin/upload/<?php echo htmlspecialchars($selected_event['event_image']); ?>" 
                                 alt="<?php echo htmlspecialchars($selected_event['event_name']); ?>" 
                                 class="w-full sm:w-48 h-48 object-cover rounded-lg">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($selected_event['event_name']); ?></h2>
                                <div class="flex items-center text-gray-600 text-sm mt-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span><?php echo htmlspecialchars($selected_event['event_date']); ?></span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm mt-2">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span><?php echo htmlspecialchars($selected_event['event_start_time']); ?></span>
                                    &nbsp;to&nbsp;
                                    <span><?php echo htmlspecialchars($selected_event['event_end_time']); ?></span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span><?php echo htmlspecialchars($selected_event['event_location']); ?></span>
                                </div>
                                <div class="mt-3 text-sm text-gray-700">
                                    <p><?php echo nl2br(htmlspecialchars($selected_event['event_description'])); ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-red-600">No event selected.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Ticket Types -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Available Tickets</h3>
                    
                    <div class="space-y-4">
                        <!-- General Admission -->
                        <div class="border rounded-lg p-4 hover:border-[#009332] transition">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                <div>
                                    <h4 class="font-medium text-gray-800">General Admission</h4>
                                    <p class="text-sm text-gray-500">Standard event entry</p>
                                </div>
                                <div class="flex flex-col sm:items-end">
                                    <?php if ($selected_event): ?>
                                        <span class="text-lg font-semibold">₱<?php echo number_format($selected_event['ticket_price'], 2); ?></span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <?php echo $selected_event['ticket_quantity']; ?> tickets remaining
                                        </div>
                                    <?php else: ?>
                                        <span class="text-lg font-semibold">₱0.00</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h3>
                    
                    <div id="ticket-summary" class="space-y-3 mb-4">
                        <?php if ($selected_event): ?>
                            <div class="flex justify-between text-sm">
                                <span>General Admission x1</span>
                                <span>₱<?php echo number_format($selected_event['ticket_price'], 2); ?></span>
                            </div>
                        <?php else: ?>
                            <div class="text-gray-500 text-sm">No tickets selected yet</div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="border-t border-b py-4 my-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span id="subtotal">
                                <?php if ($selected_event): ?>
                                    ₱<?php echo number_format($selected_event['ticket_price'], 2); ?>
                                <?php else: ?>
                                    ₱0.00
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between font-semibold mb-6">
                        <span>Total</span>
                        <span id="total">
                            <?php if ($selected_event): ?>
                                ₱<?php echo number_format($selected_event['ticket_price'], 2); ?>
                            <?php else: ?>
                                ₱0.00
                            <?php endif; ?>
                        </span>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-800 mb-3">Payment Method</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <input id="gcash" name="payment" type="radio" class="h-4 w-4 text-[#009332] focus:ring-[#009332] border-gray-300" checked>
                                <label for="gcash" class="ml-3 block text-sm font-medium text-gray-700">
                                    <div class="flex items-center">
                                        <img src="/public/image/gcash.png" alt="GCash" class="h-6 ml-2 rounded-lg">
                                        <span class="ml-2">GCash</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- GCash Payment Instructions -->
                    <div id="gcash-instructions" class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-mobile-alt text-blue-400 mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    <strong>GCash Payment Instructions:</strong> After reservation, you will receive payment details via SMS/Email. Complete payment within 24 hours to confirm your tickets.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="" method="POST">
                        <?php if ($selected_event): ?>
                            <input type="hidden" name="event_id" value="<?php echo $selected_event['event_id']; ?>">
                            <input type="hidden" name="ticket_quantity" value="1">
                            <input type="hidden" name="total_amount" value="<?php echo $selected_event['ticket_price']; ?>">
                            <input type="hidden" name="payment_method" value="GCash">
                            
                            <button type="button" onclick="document.getElementById('purchaseModal').classList.remove('hidden');" 
                                    class="w-full bg-[#009332] hover:bg-[#007A2A] text-white py-3 px-4 rounded-md transition font-medium">
                                Buy Ticket
                            </button>
                        <?php else: ?>
                            <button type="button" disabled class="w-full bg-gray-400 text-white py-3 px-4 rounded-md font-medium cursor-not-allowed">
                                Select an event first
                            </button>
                        <?php endif; ?>
                    </form>
                    
                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <i class="fas fa-shield-alt mr-2 text-[#009332]"></i>
                        <span>100% Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include("./confirmPurchase.php");?>
</body>
</html>