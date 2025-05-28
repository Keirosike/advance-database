    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ticket Purchase</title>
    <link rel="stylesheet" href="/src/output.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                            <img src="https://via.placeholder.com/300x200" alt="Event Image" class="w-full sm:w-48 h-48 object-cover rounded-lg">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Summer Music Festival 2023</h2>
                                <div class="flex items-center text-gray-600 text-sm mt-2">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <span>Saturday, July 15 • 4:00 PM</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Central Park, New York</span>
                                </div>
                                <div class="mt-3 text-sm text-gray-700">
                                    <p>Join us for the biggest music festival of the summer featuring top artists from around the world.</p>
                                </div>
                            </div>
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
                                        <span class="text-lg font-semibold">$49.99</span>
                                        <div class="flex items-center mt-2 sm:mt-0">
                                            <button class="quantity-btn decrease w-8 h-8 rounded-full border cursor-pointer border-gray-300 flex items-center justify-center hover:bg-gray-100" data-ticket-type="general">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            <span class="quantity mx-3 w-8 text-center" data-ticket-type="general">0</span>
                                            <button class="quantity-btn increase w-8 h-8 rounded-full border cursor-pointer border-gray-300 flex items-center justify-center hover:bg-gray-100" data-ticket-type="general">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
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
                            <!-- Tickets will be added here dynamically -->
                            <div class="text-gray-500 text-sm">No tickets selected yet</div>
                        </div>
                        
                        <div class="border-t border-b py-4 my-4">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span id="subtotal">$0.00</span>
                            </div>
                        
                        </div>
                        
                        <div class="flex justify-between font-semibold mb-6">
                            <span>Total</span>
                            <span id="total">$0.00</span>
                        </div>
                        
                        <button id="checkout-btn" class="w-full bg-[#009332] hover:bg-[#007A2A] text-white py-3 px-4 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Continue to Checkout
                        </button>
                        
                        <div class="mt-4 flex items-center text-sm text-gray-500">
                            <i class="fas fa-shield-alt mr-2 text-[#009332]"></i>
                            <span>100% Secure Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ticketPrices = {
                    general: 49.99,
                    
                };
                
                const serviceFeeRate = 0.1; // 10% service fee
                
                // Quantity buttons functionality
                document.querySelectorAll('.quantity-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const type = this.getAttribute('data-ticket-type');
                        const quantityElement = document.querySelector(`.quantity[data-ticket-type="${type}"]`);
                        let quantity = parseInt(quantityElement.textContent);
                        
                        if (this.classList.contains('increase')) {
                            quantity++;
                        } else if (this.classList.contains('decrease') && quantity > 0) {
                            quantity--;
                        }
                        
                        quantityElement.textContent = quantity;
                        updateOrderSummary();
                    });
                });
                
                // Update order summary
                function updateOrderSummary() {
                    const ticketSummary = document.getElementById('ticket-summary');
                    let subtotal = 0;
                    let hasTickets = false;
                    
                    // Clear current summary
                    ticketSummary.innerHTML = '';
                    
                    // Calculate totals for each ticket type
                    for (const type in ticketPrices) {
                        const quantity = parseInt(document.querySelector(`.quantity[data-ticket-type="${type}"]`).textContent);
                        
                        if (quantity > 0) {
                            hasTickets = true;
                            const price = ticketPrices[type];
                            const total = quantity * price;
                            subtotal += total;
                            
                            // Add ticket to summary
                            const ticketDiv = document.createElement('div');
                            ticketDiv.className = 'flex justify-between text-sm';
                            ticketDiv.innerHTML = `
                                <span>${quantity} x ${type.charAt(0).toUpperCase() + type.slice(1)}</span>
                                <span>$${total.toFixed(2)}</span>
                            `;
                            ticketSummary.appendChild(ticketDiv);
                        }
                    }
                    
                    // Show message if no tickets selected
                    if (!hasTickets) {
                        ticketSummary.innerHTML = '<div class="text-gray-500 text-sm">No tickets selected yet</div>';
                    }
                    
                    // Calculate fees and totals
                    const serviceFee = subtotal * serviceFeeRate;
                    const total = subtotal + serviceFee;
                    
                    // Update display
                    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
                    document.getElementById('service-fee').textContent = `$${serviceFee.toFixed(2)}`;
                    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
                    
                    // Enable/disable checkout button
                    document.getElementById('checkout-btn').disabled = !hasTickets;
                }
                
                // Checkout button functionality
                document.getElementById('checkout-btn').addEventListener('click', function() {
                    // In a real implementation, this would redirect to checkout
                    alert('Redirecting to secure checkout...');
                    // window.location.href = '/checkout';
                });
            });
        </script>
    </body>
    </html>