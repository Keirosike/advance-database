<?php
session_start();
include("../database/conn.php");
include("./transactionFunction.php"); // Your class for inserting purchase

$failedTransaction = false;
$successTransaction = false;
$message="";

// 1. Handle event selection (store event in session)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id']) && !isset($_POST['confirmPurchaseBtn'])) {
    $event_id = $_POST['event_id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
        $stmt->execute([$event_id]);    
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            $_SESSION['selected_event'] = $event;
        } else {
            echo "Event not found.";
           $failedTransaction = true;
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit;
    }
}

// 2. Handle purchase confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmPurchaseBtn'])) {
    $user_id = $_SESSION['user']['user_id'] ?? null; // Logged in user ID
    $selected_event = $_SESSION['selected_event'] ?? null;

    $quantity = $_POST['ticket_quantity'] ?? 0;
    $quantity = (int)$quantity;

    if (!$user_id) {
               $failedTransaction = true;
        $message= "User not logged in.";

    }

    if (!$selected_event) {
               $failedTransaction = true;
        $message =  "No event selected.";
 
    }

    if ($quantity <= 0) {
         $failedTransaction = true;
        $message="Invalid ticket quantity.";
        include ("./successTransaction.php");
      
    }

    $event_id = $selected_event['event_id'];
    $price_per_ticket = $selected_event['ticket_price'];
    $payment_method = $_POST['payment_method'] ?? 'GCash';
 
    $transaction = new Transaction($conn);
    $success = $transaction->purchaseTicket($user_id, $event_id, $quantity, $price_per_ticket, $payment_method);

    if ($success) {
       $successTransaction=true;
       include ("./successTransaction.php");
        
       
   
        
    } else {
          $failedTransaction = true;
        $message =  "Failed to record purchase. Please try again.";
            include ("./successTransaction.php");
       
    }
}

// You can now use $selected_event to display details in your form/UI
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
            <link rel="icon" href="/public/image/dnscLogo.png"
        type="image/x-icon" />
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
                            <img src="/admin/upload/<?php echo htmlspecialchars($selected_event['event_image']); ?>" alt="<?php echo htmlspecialchars($selected_event['event_name']); ?>" class="w-full sm:w-48 h-48 object-cover rounded-lg">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($selected_event['event_name']); ?></h2>
                                <div class="flex items-center text-gray-600 text-sm mt-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span><?php echo htmlspecialchars($selected_event['event_date']); ?></span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm mt-2">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span><?php echo htmlspecialchars($selected_event['event_start_time']); ?></span>&nbsp; to &nbsp;<span><?php echo htmlspecialchars($selected_event['event_end_time']); ?></span>
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
                                    <?php else: ?>
                                        <span class="text-lg font-semibold">₱0.00</span>
                                    <?php endif; ?>
                                    <div class="flex items-center mt-2 sm:mt-0">
                                        <button class="quantity-btn decrease w-8 h-8 rounded-full border cursor-pointer border-gray-300 flex items-center justify-center hover:bg-gray-100" data-ticket-type="general">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        
                                        <span class="quantity mx-3 w-8 text-center" data-ticket-type="general">0</span>
                                        <button class="quantity-btn increase w-8 h-8 rounded-full border cursor-pointer border-gray-300 flex items-center justify-center hover:bg-gray-100" data-ticket-type="general">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                     <input type="hidden" name="ticket_quantity" id="ticket_quantity_input" value="0" />
                                    <?php if ($selected_event): ?>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <?php echo $selected_event['ticket_quantity']; ?> tickets remaining
                                        </div>
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
                        <div class="text-gray-500 text-sm">No tickets selected yet</div>
                    </div>
                    
                    <div class="border-t border-b py-4 my-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span id="subtotal">₱0.00</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between font-semibold mb-6">
                        <span>Total</span>
                        <span id="total">₱0.00</span>
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
                        <?php endif; ?>
                        <input type="hidden" name="ticket_quantity" id="form_quantity" value="0">
                        <input type="hidden" name="total_amount" id="form_total" value="0">
                        <input type="hidden" name="payment_method" value="GCash">
                        
                        <button type="button" id="checkout-btn" onclick="openConfirmPurchaseModal(<?php echo $selected_event['event_id']; ?>)" class="w-full bg-[#009332] hover:bg-[#007A2A] text-white py-3 px-4 rounded-md transition focus:outline-none focus:ring-2 cursor-pointer font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Buy Ticket
                        </button>
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

    <script>
        // Simple quantity adjustment functionality
        document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function() {
        const ticketType = this.getAttribute('data-ticket-type');
        const quantityElement = document.querySelector(`.quantity[data-ticket-type="${ticketType}"]`);
        const hiddenInput = document.getElementById('ticket_quantity_input'); // your hidden input

        let quantity = parseInt(quantityElement.textContent);
        const maxQuantity = <?php echo $selected_event['ticket_quantity'] ?? 0; ?>;

        if (this.classList.contains('increase') && quantity < maxQuantity) {
            quantity++;
        } else if (this.classList.contains('decrease') && quantity > 0) {
            quantity--;
        }

        quantityElement.textContent = quantity;
        hiddenInput.value = quantity; // update hidden input
        updateOrderSummary();
    });
});
        
        function updateOrderSummary() {
            const ticketSummary = document.getElementById('ticket-summary');
            const subtotalElement = document.getElementById('subtotal');
            const totalElement = document.getElementById('total');
            const checkoutBtn = document.getElementById('checkout-btn');
            const formQuantity = document.getElementById('form_quantity');
            const formTotal = document.getElementById('form_total');
            
            // Get all ticket quantities and prices
            const generalQty = parseInt(document.querySelector('.quantity[data-ticket-type="general"]').textContent);
            <?php if ($selected_event): ?>
                const ticketPrice = <?php echo $selected_event['ticket_price']; ?>;
         
            <?php endif; ?>
            
            // Calculate totals
            const generalTotal = generalQty * ticketPrice;
            const subtotal = generalTotal;
            const total = subtotal;
            
            // Update ticket summary
            if (generalQty > 0) {
                ticketSummary.innerHTML = `
                    <div class="flex justify-between text-sm">
                        <span>General Admission x${generalQty}</span>
                        <span>₱${generalTotal.toFixed(2)}</span>
                    </div>
                `;
            } else {
                ticketSummary.innerHTML = '<div class="text-gray-500 text-sm">No tickets selected yet</div>';
            }
            
            // Update totals
            subtotalElement.textContent = `₱${subtotal.toFixed(2)}`;
            totalElement.textContent = `₱${total.toFixed(2)}`;
            
            // Update form hidden fields
            formQuantity.value = generalQty;
            formTotal.value = total;
            
            // Enable/disable checkout button
            checkoutBtn.disabled = total <= 0;
        }
function openConfirmPurchaseModal(eventId) {
    const quantity = parseInt(document.getElementById('form_quantity').value) || 0;
    if (quantity <= 0) {
        alert('Please select at least one ticket to proceed.');
        return;
    }
    document.getElementById('purchaseEventId').value = eventId;
    document.getElementById('modal_ticket_quantity').value = quantity; // sync quantity to modal input
    document.getElementById('purchaseModal').classList.remove('hidden');
}

    </script>
</body>
</html>