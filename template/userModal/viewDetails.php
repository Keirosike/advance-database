<!-- View Details Modal Container -->
<div id="view-details-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-[rgba(0,0,0,0.5)]">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <!-- Close button -->
                        <div class="flex justify-end">
                            <button onclick="document.getElementById('view-details-modal').classList.add('hidden')" 
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Event content -->
                        <div id="event-details-content" class="mt-2">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Event Image -->
                                <div class="w-full md:w-1/2">
                                    <img id="modal-event-image" src="" alt="Event Image" class="w-full h-64 md:h-96 object-cover rounded-lg">
                                </div>
                                
                                <!-- Event Details -->
                                <div class="w-full md:w-1/2">
                                    <h3 id="modal-event-name" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                                    
                                    <div class="flex items-center mb-1">
                                        <span id="modal-event-type" class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full"></span>
                                    </div>
                                    
                                    <div class="flex items-center text-gray-600 text-sm mb-1">
                                        <svg class="h-4 w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span id="modal-event-location"></span>
                                    </div>
                                    
                                    <div class="space-y-1 mb-3">
                                        <div class="flex items-center text-gray-600 text-sm">
                                            <svg class="h-4 w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span id="modal-event-date"></span>
                                        </div>
                                        
                                        <div class="flex items-center text-gray-600 text-sm ">
                                            <svg class="h-4 w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>
                                                <span id="modal-event-start-time"></span> to 
                                                <span id="modal-event-end-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-gray-600 text-sm mb-4">
                                        <span id="modal-ticket-price" class="font-medium"></span>
                                        <span id="modal-ticket-remaining" class="ml-2"></span>
                                    </div>
                                    
                                    <div class="border-t border-gray-200 pt-4 mb-4">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">About this event</h4>
                                        <p id="modal-event-description" class="text-gray-600 text-sm"></p>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <form action="../transaction/ticketPurchase.php" method="POST">
                                            <input type="hidden" name="event_id" id="modal-event-id">
                                            <input type="hidden" name="quantity" value="1">
                                            
                                            <button type="submit" id="buy-ticket-btn" class="w-full bg-[#009332] hover:bg-[#007A2A] text-white py-2 px-4 rounded-md transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
                                                Buy Ticket
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewDetailsButtons = document.querySelectorAll('.view-details-btn');
        
        viewDetailsButtons.forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');
                const eventCard = this.closest('.event-card');
                
                document.getElementById('modal-event-id').value = eventId;
                
                // Extract data from the card
                const eventName = eventCard.querySelector('h3').textContent;
                const eventType = eventCard.querySelector('.event-type').textContent;
                const eventLocation = eventCard.querySelector('.event-location').textContent;
                
                // Get date and time separately
                const dateTimeText = eventCard.querySelector('.event-date').textContent;
                const [eventDate, eventTime] = dateTimeText.split(' • ');
                
                const ticketPrice = eventCard.querySelector('div:nth-child(4) span').textContent;
                const eventImage = eventCard.querySelector('img').src;
                
                // Get additional event data from attributes
                const startTime = eventCard.getAttribute('data-start-time');
                const endTime = eventCard.getAttribute('data-end-time');
                const description = eventCard.getAttribute('data-description');
        const remainingTickets = parseInt(eventCard.getAttribute('data-ticket-quantity') || '0');

                
                // Populate the modal
                document.getElementById('modal-event-name').textContent = eventName;
                document.getElementById('modal-event-type').textContent = eventType;
                document.getElementById('modal-event-location').textContent = eventLocation;
                document.getElementById('modal-event-date').textContent = eventDate;
                document.getElementById('modal-event-start-time').textContent = startTime || eventTime;
                document.getElementById('modal-event-end-time').textContent = endTime || '';
                document.getElementById('modal-ticket-price').textContent = 'Price: ' + ticketPrice;
                document.getElementById('modal-event-image').src = eventImage;
                document.getElementById('modal-event-description').textContent = description || 'No description available.';

                // Set ticket remaining text
                const ticketRemainingEl = document.getElementById('modal-ticket-remaining');
                if (remainingTickets <= 0) {
                    ticketRemainingEl.textContent = "Sold out";
                    ticketRemainingEl.classList.add("text-red-600");
                    ticketRemainingEl.classList.remove("text-blue-600");
                } else {
                    ticketRemainingEl.textContent = remainingTickets + " tickets remaining";
                    ticketRemainingEl.classList.add("text-blue-600");
                    ticketRemainingEl.classList.remove("text-red-600");
                }

                const buyBtn = document.getElementById('buy-ticket-btn');
                const now = new Date();
                const eventDateTime = new Date(`${eventDate} ${startTime || eventTime}`);

                if (eventDateTime < now || remainingTickets <= 0) {
                    buyBtn.disabled = true;
                    buyBtn.textContent = remainingTickets <= 0 ? "Sold Out" : "Ticket Unavailable";
                    buyBtn.classList.add("bg-gray-400", "cursor-not-allowed");
                    buyBtn.classList.remove("bg-[#009332]", "hover:bg-[#007A2A]");
                } else {
                    buyBtn.disabled = false;
                    buyBtn.textContent = "Buy Ticket";
                    buyBtn.classList.add("bg-[#009332]", "hover:bg-[#007A2A]");
                    buyBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
                }
                
                // Show the modal
                document.getElementById('view-details-modal').classList.remove('hidden');
            });
        });
        
        // Close modal when clicking outside
        document.getElementById('view-details-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });
</script>