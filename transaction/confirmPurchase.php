<!-- Confirm Purchase Modal -->
<form id="purchaseForm" method="POST">
    <input type="hidden" name="eventIdToPurchase" id="purchaseEventId"> <!-- Hidden input for event ID -->
      <input type="hidden" name="ticket_quantity" id="modal_ticket_quantity" value="0">

    <div id="purchaseModal" class=" fixed hidden inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Confirm Purchase</h3>
                    <button type="button" onclick="closePurchaseModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-gray-600 mb-6">Are you sure you want to purchase this event ticket? Please confirm to proceed.</p>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closePurchaseModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 cursor-pointer" name="confirmPurchaseBtn">
                        Confirm Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
