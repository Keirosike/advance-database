
<div id="editProfileModal" class="fixed inset-0 z-50 hidden overflow-y-hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0 bg-[rgba(0,0,0,0.5)]">
        
        
        <!-- Modal container -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <!-- Modal header -->
            <div class="bg-[#009332] px-4 py-3 sm:px-6 sm:flex sm:items-center sm:justify-between">
                <h3 class="text-lg leading-6 font-medium text-white">
                    Edit Profile
                </h3>
                <button onclick="closeEditProfileModal()" class="text-white hover:text-gray-200 focus:outline-none">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form id="profileForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="save_profile" value="1">
                          <input type="hidden" name="user_id" value="<?= htmlspecialchars($profileData['user_id']) ?>">
                    <div class="space-y-4">
                        <!-- Avatar Upload -->
                        <div class="flex flex-col items-center">
                            <div class="relative mb-4">
                                <img id="profilePreview" src="<?= !empty($profileData['profile_image']) ?'upload/'. $profileData['profile_image'] : '/public/image/user.png' ?>" alt="" class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-md">
                                <label for="profileImage" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-camera text-gray-600"></i>
                                    <input type="file" id="profileImage" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                                </label>
                            </div>
                        </div>
                        
                        <!-- Full Name -->
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" id="firstName" name="first_name"  value=  <?= htmlspecialchars( $profileData['first_name']) ?> class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-[#009332] focus:border-[#009332] sm:text-sm">
                        </div>
                          <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" id="lastName" name="last_name"  value=  <?= htmlspecialchars($profileData['last_name'] ) ?> class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-[#009332] focus:border-[#009332] sm:text-sm">
                        </div>
                        <!-- Email -->
                     <div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="email" id="email" name="email"   value="<?= htmlspecialchars($profileData['email']) ?>"
           class="mt-1 block w-full border border-gray-200 rounded-md py-2 px-3 
                  focus:outline-none focus:ring-[#009332] focus:border-[#009332] sm:text-sm
                  bg-gray-50 text-gray-600 cursor-not-allowed" 
           disabled>
</div>
                        
                        <!-- Contact Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="tel" id="phone" name="contact_number" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-[#009332] focus:border-[#009332] sm:text-sm"      value="<?= htmlspecialchars($profileData['contact_number']?? 'N/A') ?>">
                        </div>
                    

                        <!-- Student ID -->
                        <div>
                            <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
                            <input type="text" id="studentId" name="student_id"  class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-[#009332] focus:border-[#009332] sm:text-sm" value="<?= htmlspecialchars($profileData['student_id']?? 'N/A') ?>">
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="saveProfile()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#009332] text-base font-medium text-white hover:bg-[#007A2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009332] sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                    Save Changes
                </button>
                <button type="button" onclick="closeEditProfileModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009332] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm cursor-pointer">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openEditProfileModal() {
        document.getElementById('editProfileModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeEditProfileModal() {
        document.getElementById('editProfileModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Image preview function
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
 function saveProfile() {
    const form = document.getElementById('profileForm');
    form.submit();
    
}
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editProfileModal');
        if (event.target === modal) {
            closeEditProfileModal();
        }
    }
</script>