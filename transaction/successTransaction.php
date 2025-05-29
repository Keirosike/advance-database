<?php if(isset($successTransaction) && $successTransaction): ?>
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center transition-opacity duration-300 opacity-0 animate-fadeIn">
        <div class="bg-white rounded-xl w-11/12 max-w-md p-6 shadow-xl transform transition-all duration-300 scale-95 animate-scaleIn relative">
            <!-- Close button (X) -->
            <button onclick="closeSuccessModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="flex flex-col items-center">
                <!-- Animated checkmark -->
                <div class="w-24 h-24 mb-4 flex items-center justify-center">
                    <svg class="checkmark animate-drawCheck" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#10B484" stroke-width="2"/>
                        <path class="checkmark-check" fill="none" stroke="#10B484" stroke-width="4" stroke-linecap="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-1">
                    Ticket purchased <span class="text-[#10B484]">successfully</span>!
                </h1>
                
                <!-- Close button -->
                <button onclick="closeSuccessModal()" class=" cursor-pointer mt-4 px-6 py-2 bg-[#10B484] text-white rounded-lg hover:bg-[#0D926C] transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeSuccessModal() {
            const modal = document.getElementById('successModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
        window.location.href = '../userPage/browseEvent.php';
    }, 300); 
        }
    </script>
<?php endif; ?>

<?php if(isset($failedTransaction) && $failedTransaction): ?>
    <!-- Failure Modal -->
    <div id="failedModal" class="fixed inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center transition-opacity duration-300 opacity-0 animate-fadeIn">
        <div class="bg-white rounded-xl w-11/12 max-w-md p-6 shadow-xl transform transition-all duration-300 scale-95 animate-scaleIn relative">
            <!-- Close button (X) -->
            <button onclick="closeFailedModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <div class="flex flex-col items-center">
                <!-- Animated X mark -->
                <div class="w-20 h-20 mb-4 flex items-center justify-center relative">
                    <div class="absolute w-full h-1 bg-[#e2382f] transform rotate-45 rounded-full animate-drawXFirst"></div>
                    <div class="absolute w-full h-1 bg-[#e2382f] transform -rotate-45 rounded-full animate-drawXSecond"></div>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-1">
                    <span class="text-[#e2382f]">Failed</span> to buy ticket.
                </h1>
                <p class="text-[#e2382f] text-center font-medium"><?php echo htmlspecialchars($message); ?></p>
                
                <!-- Close button -->
                <button onclick="closeFailedModal()" class="mt-4 px-6 py-2 bg-[#e2382f] text-white rounded-lg hover:bg-[#c5302a] transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeFailedModal() {
            const modal = document.getElementById('failedModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                 window.location.href = '../userPage/browseEvent.php';
    }, 300);
          
        }
    </script>
<?php endif; ?>

<style>
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    @keyframes scaleIn {
        from { transform: scale(0.95); }
        to { transform: scale(1); }
    }
    @keyframes progressBar {
        from { width: 0%; }
        to { width: 100%; }
    }
    @keyframes drawCheck {
        0% { stroke-dashoffset: 100; }
        100% { stroke-dashoffset: 0; }
    }
    @keyframes drawXFirst {
        0% { transform: scaleX(0) rotate(45deg); }
        100% { transform: scaleX(1) rotate(45deg); }
    }
    @keyframes drawXSecond {
        0% { transform: scaleX(0) rotate(-45deg); }
        100% { transform: scaleX(1) rotate(-45deg); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s forwards;
    }
    .animate-scaleIn {
        animation: scaleIn 0.3s forwards;
    }
    .animate-progressBar {
        animation: progressBar 2.8s linear forwards;
    }
    .animate-drawCheck {
        animation: drawCheck 0.8s ease-in-out forwards;
    }
    .animate-drawXFirst {
        animation: drawXFirst 0.4s ease-out forwards;
    }
    .animate-drawXSecond {
        animation: drawXSecond 0.4s ease-out forwards;
        animation-delay: 0.2s;
    }
    
    /* Checkmark styles */
    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        animation: drawCheck 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        animation-delay: 0.3s;
    }
    .checkmark-check {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: drawCheck 0.3s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        animation-delay: 0.8s;
    }
</style>