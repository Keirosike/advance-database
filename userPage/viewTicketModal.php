
<div id="ticket-modal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden hidden bg-[rgba(0,0,0,0.5)] transition-opacity duration-300" id="ticketModal">
  <div class="relative mx-4 w-full max-w-md transform rounded-lg bg-white p-6 shadow-2xl transition-all duration-300 ease-in-out" id="modalContent">
    <!-- Close button -->
    <button class="absolute right-4 top-4 rounded-full p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none" id="closeModal">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    
    <!-- Header -->
    <div class="mb-6 text-center">
      <h2 class="text-2xl font-bold text-gray-800">Your Ticket</h2>
      <div class="mx-auto mt-2 h-1 w-20 rounded-full bg-[#009332]"></div>
    </div>
    
    <!-- Ticket content -->
    <div class="flex flex-col space-y-6 md:flex-row md:space-x-6 md:space-y-0">
      <!-- Event details -->
      <div class="flex-1 space-y-4">
        <div>
          <h3 class="text-xl font-semibold text-gray-800" id="eventName"></h3>
          <p class="text-sm text-gray-500" id="ticketType"></p>
        </div>
        <div class="space-y-3 text-gray-600">
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 flex-shrink-0 text-[#009332]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div>
              <p class="font-medium" id="eventDate">Oct 15, 2023</p>
              <p class="text-sm text-gray-500" id="eventDay">Sunday</p>
            </div>
          </div>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 flex-shrink-0 text-[#009332]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
            <p class="font-medium" id="eventTime"></p>
            </div>
          </div>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 flex-shrink-0 text-[#009332]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <div>
              <p class="font-medium" id="eventLocation"></p>
              <p class="text-sm text-gray-500">Davao del Norte State College</p>
            </div>
          </div>
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-5 w-5 flex-shrink-0 text-[#009332]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <div>
              <p class="font-medium" >Ticket Holder: <span class="font-normal" id="ticketHolder"></span></p>
             
            </div>
          </div>
        </div>
      </div>
      
      <!-- QR code container -->
      <div class="flex flex-col items-center justify-center space-y-2 rounded-lg border-2 border-dashed border-gray-300 p-4 w-48">
        <div class="flex h-48 w-48 items-center justify-center rounded bg-gray-100 p-2" id="qrCodeContainer">
          <!-- QR code will be inserted here -->
          <div class="flex h-full w-full items-center justify-center bg-white">
     <img id="qrCodeImage" src="" alt="QR Code" class="h-full w-full object-contain" />
          </div>
        </div>
        <p class="text-xs font-medium text-gray-500">Scan this code at entry</p>
        <div class="flex items-center space-x-1">
          <span class="h-2 w-2 rounded-full bg-green-400"></span>
          <span class="text-xs text-gray-500">Valid for entry</span>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    <div class="mt-6 flex flex-col space-y-3 border-t pt-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
      <div>
        <p class="text-sm text-gray-500" id="ticketNumber"></p>
        <p class="text-xs text-gray-400" id="issueDate"></p>
      </div>
      <div class="flex space-x-2">
        <button id="shareBtn" class="cursor-pointer rounded-md border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
      Share
        </button>
        <button id="downloadQrBtn" class=" cursor-pointer rounded-md bg-[#009332] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#007A2A] focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2">
         Download
        </button>
      </div>
    </div>
    
    <!-- Event terms -->
    <div class="mt-4 border-t pt-3">
      <p class="text-xs text-gray-400">* This ticket is non-transferable. Valid student ID required for entry.</p>
    </div>
  </div>
</div>

<!-- JavaScript to handle the modal -->
<script>

  document.addEventListener('DOMContentLoaded', function () {
    const ticketButtons = document.querySelectorAll('[data-ticket-button]');
    const modal = document.getElementById('ticket-modal');
    const closeModalBtn = modal.querySelector('#closeModal');
    const downloadBtn = document.getElementById('downloadQrBtn');
    const shareBtn = document.getElementById('shareBtn');

    ticketButtons.forEach(button => {
      button.addEventListener('click', () => {
        // Populate modal content from button data
        modal.querySelector('#eventName').textContent = button.dataset.event;
        modal.querySelector('#ticketType').textContent = "General Admission"; // update if dynamic
        modal.querySelector('#eventDate').textContent = button.dataset.date;
        modal.querySelector('#eventDay').textContent = button.dataset.day;
        modal.querySelector('#eventTime').textContent = button.dataset.time;
        modal.querySelector('#eventLocation').textContent = button.dataset.location;
        modal.querySelector('#ticketHolder').textContent = button.dataset.holder;
        modal.querySelector('#ticketNumber').textContent = button.dataset.ticketNumber;
        modal.querySelector('#issueDate').textContent = button.dataset.issueDate;
         const qrCodeImage = modal.querySelector('#qrCodeImage');
  qrCodeImage.src = `../qrCode/qrConverter.php?text=${encodeURIComponent(button.dataset.ticketNumber)}`;

        // Show modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      });
    });

    // Close modal
    closeModalBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    });

    // Close when clicking outside modal content
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      }
    });
    
  downloadBtn.addEventListener('click', () => {
    const qrImage = document.getElementById('qrCodeImage');
    const imageURL = qrImage.src;
    const filename = qrImage.getAttribute('data-filename') || 'ticket-qr.png';

    // Create a temporary link
    const link = document.createElement('a');
    link.href = imageURL;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });
  shareBtn.addEventListener('click', async () => {
  const eventName = modal.querySelector('#eventName').textContent;
  const ticketNumber = modal.querySelector('#ticketNumber').textContent;
  const qrCodeImage = modal.querySelector('#qrCodeImage').src;
  const shareText = `Ticket for ${eventName}\nTicket Number: ${ticketNumber}\nCheck your QR code here: ${qrCodeImage}`;

  if (navigator.share) {
    try {
      await navigator.share({
        title: `Ticket for ${eventName}`,
        text: shareText,
        url: qrCodeImage // can share the QR code image URL or event URL
      });
      console.log('Ticket shared successfully');
    } catch (error) {
      console.error('Error sharing:', error);
    }
  } else {
    alert('Sharing not supported on this browser. You can copy the ticket info manually.');
  }
});
  });

</script>


