 <!-- Delete Confirmation Modal -->
<form id="deleteForm" method="POST">
    <input type="hidden" name="eventIdToDelete" id="deleteEventId"> <!-- Hidden input for event ID -->

    <div id="deleteModal" class="hidden fixed inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Confirm Deletion</h3>
                    <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this event? This action cannot be undone.</p>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700 cursor-pointer" name="deleteEventBtn">
                        Delete Event
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>