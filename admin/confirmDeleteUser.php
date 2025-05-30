<form id="deleteForm" method="POST">
    <div id="deleteUserModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-[rgba(0,0,0,0.5)]">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete User</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Are you sure you want to delete this user? All of their data will be permanently removed. This action cannot be undone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <input type="hidden" id="deleteUserId" name="user_id" value="">
                    <button type="submit" name="confirmDeleteUserBtn" id="confirmDeleteBtn" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button type="button" onclick="closeDeleteUserModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
    <script>
       
let currentUserId = null;

function confirmDeleteUser(userId) {
    currentUserId = userId;
    document.getElementById('deleteUserId').value = userId;
    document.getElementById('deleteUserModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteUserModal() {
    document.getElementById('deleteUserModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
    currentUserId = null;
}

// Optional: If you want to handle deletion via AJAX or confirmation here, otherwise form submission will handle it
document.getElementById('confirmDeleteBtn').addEventListener('click', function(event) {
    if (!currentUserId) {
        event.preventDefault(); // prevent submit if no user ID
        alert('No user selected for deletion!');
    }
});

    </script>