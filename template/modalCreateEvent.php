<div class="bg-[rgba(0,0,0,0.4)] w-screen h-screen flex items-center justify-center fixed top-0 left-0 z-50">
    <div class="bg-white w-[32.5rem] max-h-[90vh] rounded-md shadow-lg p-4 relative overflow-y-auto" id="createEvent">


        <div class="sticky top-0 bg-white z-10 pb-4">
            <div class="w-full border-b border-gray-200 flex items-center justify-between p-4">
                <h1 class="text-2xl text-gray-900 font-bold">Create <span class="text-[#009332]">Event</span></h1>
                <button onclick="closeModal()" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <form action="" method="POST" class="p-6 space-y-4" enctype="multipart/form-data">
            
        <!-- event image upload -->
            <div class="space-y-2">
            <div id="imagePreview" class="hidden flex item-center justify-center">
                    <img id="previewImage" class="h-50 w-auto object-cover rounded-md border border-gray-200" src="#" alt="Event image preview">
                </div>
               
                <div class="flex items-center justify-center w-full">
              
                
                <label for="eventImage" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                           
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG (MAX. 5MB)</p>
                        </div>
                        <input id="eventImage" name="eventImage" type="file" class="hidden" accept="image/*" required />
                    </label>
                </div>
               
            </div>

            
            <!-- event name -->
            <div class="space-y-2">
                <label for="eventName" class="block text-sm font-medium text-gray-700">Event Name*</label>
                <input 
                    type="text" 
                    id="eventName" 
                    name="eventName"
                    placeholder="Enter event name" 
                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                    required
                >
            </div>
            
            
            <!-- event date and time -->
            <div class="grid grid-cols-3 gap-4">
                <div class="space-y-2">
                    <label for="eventDate" class="block text-sm font-medium text-gray-700">Date*</label>
                    <input 
                        type="date" 
                        id="eventDate" 
                        name="eventDate"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required
                    >
                </div>
                <div class="space-y-2">
                    <label for="eventTime" class="block text-sm font-medium text-gray-700">Start Time*</label>
                    <input 
                        type="time" 
                        id="eventTime" 
                        name="eventTime"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required
                    >
                </div>
                <div class="space-y-2">
                    <label for="eventTime" class="block text-sm font-medium text-gray-700">End Time*</label>
                    <input 
                        type="time" 
                        id="eventTime" 
                        name="eventTime"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required
                    >
                </div>
            </div>
            
            <!-- event type dropdown -->
            <div class="space-y-2">
                <label for="eventType" class="block text-sm font-medium text-gray-700">Event Type*</label>
                <select 
                    id="eventType" 
                    name="eventType"
                    class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                    required
                >
                    <option value="" disabled selected>Select event type</option>
                    <option value="meeting">Theatre</option>
                    <option value="conference">Movie</option>
                    <option value="workshop">Sing and Dance</option>
                    <option value="social">Sports</option>
                    <option value="other">Conference</option>
                    <option value="other">Meeting</option>
                </select>
            </div>

            <!-- event location -->
            <div class="space-y-2">
                <label for="eventLocation" class="block text-sm font-medium text-gray-700">Where*</label>
                <div class="flex space-x-2">
                    <select 
                        id="eventLocationType" 
                        name="eventLocationType"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required>
                    <option value="" disabled selected>Select event location</option>
                    <option value="meeting">DNSC Sports Complex</option>
                    <option value="conference">DNSC Gymnasium</option>
                    <option value="workshop">DNSC Covered Court</option>
                    <option value="social">DNSC AB 3-4</option>
                    <option value="other">DNSC Music Room</option>
                    </select>
                  
                </div>
            </div>
           
            
            <!-- Event Description -->
            <div class="space-y-2">
                <label for="eventDescription" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea 
                    id="eventDescription" 
                    name="eventDescription"
                    rows="4" 
                    placeholder="Enter event description" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                ></textarea>
            </div>

            <div class="border border-gray-300 rounded-lg p-4 space-y-4">
            <h1 class="text-lg font-semibold text-gray-900">Tickets</h1>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="ticketPrice" class="block text-sm font-medium text-gray-700">Price (₱)*</label>
                    <input 
                        type="number" 
                        id="ticketAmount" 
                        name="ticketAmount"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required
                    >
                </div>
                <div class="space-y-2">
                    <label for="ticketQuantity" class="block text-sm font-medium text-gray-700">Quantity*</label>
                    <input 
                        type="number" 
                        id="ticketQuantity" 
                        name="ticketQuantity"
                        class="w-full h-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#009332] focus:border-transparent"
                        required
                    >
                </div>
            </div>
            </div>
            
            
            <!-- Submit Button -->
            <div class="sticky bottom-0 bg-white pt-4 pb-2">
                <button 
                    type="submit" 
                    class="w-full bg-[#009332] text-white py-3 px-4 rounded-md hover:bg-[#007a29] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 cursor-pointer"
                >
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function closeModal() {
    document.getElementById('createEvent').classList.add('hidden');
}

// Image preview functionality
const eventImage = document.getElementById('eventImage');
const imagePreview = document.getElementById('imagePreview');
const previewImage = document.getElementById('previewImage');

eventImage.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            previewImage.src = event.target.result;
            imagePreview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        imagePreview.classList.add('hidden');
    }
});


</script>