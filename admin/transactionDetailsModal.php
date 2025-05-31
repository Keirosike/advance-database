<!-- Transaction Details Modal -->
<div id="transactionDetailsModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 bg-[rgba(0,0,0,0.5)]">
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Transaction Details</h3>
                        <div class="mt-5 border-t border-gray-200">
                            <dl class="sm:divide-y sm:divide-gray-200">
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Transaction ID
                                    </dt>
                                    <dd id="modal-transaction-id" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <!-- Will be filled by JavaScript -->
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        User
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img id="modal-user-image" class="h-10 w-10 rounded-full object-cover" 
                                                    src="/userPage/upload/" 
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div id="modal-user-name" class="text-sm font-medium text-gray-900">
                                                    <!-- Will be filled by JavaScript -->
                                                </div>
                                                <div id="modal-user-email" class="text-sm text-gray-500">
                                                    <!-- Will be filled by JavaScript -->
                                                </div>
                                            </div>
                                        </div>
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Event
                                    </dt>
                                    <dd id="modal-event" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <!-- Will be filled by JavaScript -->
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Transaction Date
                                    </dt>
                                    <dd id="modal-order-date" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <!-- Will be filled by JavaScript -->
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Amount
                                    </dt>
                                    <dd id="modal-amount" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <!-- Will be filled by JavaScript -->
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                       
                                    <dt class="text-sm font-medium text-gray-500">
                                        
                                        Payment Method
                                    </dt>
                                    <div class="flex">
                                                    <i class="fa-solid fa-g text-blue-500 mr-2"></i>

                                    <dd id="modal-payment-method" class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <!-- Will be filled by JavaScript -->
                                    </dd>
                                    </div>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Status
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <span id="modal-status" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            <!-- Will be filled by JavaScript -->
                                        </span>
                                    </dd>
                                </div>
                                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Receipt
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <a id="modal-receipt-link" href="#" class="text-[#009332] hover:text-[#007A2A] underline">
                                            Download Receipt (PDF)
                                        </a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse ">
                <button type="button" onclick="closeTransactionDetails()" class="cursor-pointer w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#009332] text-base font-medium text-white hover:bg-[#007A2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009332] sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openTransactionDetails(button) {
    const modal = document.getElementById('transactionDetailsModal');
    const data = button.dataset;
    
    
    // Set transaction ID
    document.getElementById('modal-transaction-id').textContent = `#${data.id}`;
    
    // Set user info
 document.getElementById('modal-user-image').src = data.userImage
    ? `/userPage/upload/${data.userImage}`
    : '/public/image/user.png';
    document.getElementById('modal-user-image').alt = data.userName;
    document.getElementById('modal-user-name').textContent = data.userName;
    document.getElementById('modal-user-email').textContent = data.userEmail || 'N/A';
    
    // Set event info
    document.getElementById('modal-event').textContent = `${data.event} (${data.eventDate})`;
    
    // Set transaction date
    document.getElementById('modal-order-date').textContent = data.orderDate;
    
    // Set amount
    document.getElementById('modal-amount').textContent = data.amount;
    
    // Set payment method
    const paymentMethodEl = document.getElementById('modal-payment-method');
    paymentMethodEl.innerHTML = `<i class="fab fa-cc-${data.paymentMethod.toLowerCase()} text-blue-500 mr-2"></i> ${data.paymentMethod}`;
    
    // Set status
    const statusEl = document.getElementById('modal-status');
    statusEl.textContent = data.status;
    
    // Set status color based on status
    switch(data.status.toLowerCase()) {
        case 'completed':
            statusEl.className = "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800";
            break;
        case 'pending':
            statusEl.className = "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800";
            break;
        case 'failed':
        case 'cancelled':
            statusEl.className = "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800";
            break;
        default:
            statusEl.className = "px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800";
    }
    
    // Set receipt link if available
    const receiptLink = document.getElementById('modal-receipt-link');
    if (data.receiptUrl) {
        receiptLink.href = data.receiptUrl;
    } else {
        receiptLink.href = '#';
        receiptLink.textContent = 'No receipt available';
        receiptLink.classList.add('text-gray-500');
        receiptLink.classList.remove('text-[#009332]', 'underline');
    }
    
    // Show the modal
    modal.classList.remove('hidden');
}

function closeTransactionDetails() {
    document.getElementById('transactionDetailsModal').classList.add('hidden');
}
</script>