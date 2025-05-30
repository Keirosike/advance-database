<!-- Login Status Modals -->
<?php if(isset($successDeleteUser) && $successDeleteUser): ?>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center transition-opacity duration-300 opacity-0 animate-fadeIn">
        <div class="bg-white rounded-xl w-11/12 max-w-md p-6 shadow-xl transform transition-all duration-300 scale-95 animate-scaleIn">
            <div class="flex flex-col items-center">
                <!-- Animated checkmark -->
                <div class="w-24 h-24 mb-4 flex items-center justify-center">
                    <svg class="checkmark animate-drawCheck" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="#10B484" stroke-width="2"/>
                        <path class="checkmark-check" fill="none" stroke="#10B484" stroke-width="4" stroke-linecap="round" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-1">
                    User deleted <span class="text-[#10B484]">successfully</span>!
                </h1>
               
           
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
        
                    window.location.href = '../admin/event.php';
                }, 1500);   


                function closeModal() {
                    document.getElementById('successModal').classList.add('hidden');
                }

    </script>

       <?php endif;?>

<?php if(isset($failedDeleteUser) && $failedDeleteUser): ?>

    <!-- Failure Modal -->
    <div id="failedModal" class="fixed inset-0 bg-[rgba(0,0,0,0.4)] z-50 flex items-center justify-center transition-opacity duration-300 opacity-0 animate-fadeIn">
        <div class="bg-white rounded-xl w-11/12 max-w-md p-6 shadow-xl transform transition-all duration-300 scale-95 animate-scaleIn">
            <div class="flex flex-col items-center">
                <!-- Animated X mark -->
                <div class="w-20 h-20 mb-4 flex items-center justify-center relative">
                    <div class="absolute w-full h-1 bg-[#e2382f] transform rotate-45 rounded-full animate-drawXFirst"></div>
                    <div class="absolute w-full h-1 bg-[#e2382f] transform -rotate-45 rounded-full animate-drawXSecond"></div>
                </div>
                
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-1">
                     <span class="text-[#e2382f]">Failed</span> to delete user.
                </h1>
                <p class="text-[#e2382f] text-center font-medium"><?php echo htmlspecialchars($message); ?></p>
                
           
            </div>
        </div>
    </div>

    <script>
       setTimeout(function() {
            window.location.href = '../admin/event.php';
        }, 1500);   
            
                function closeModal() {
                    document.getElementById('failedModal').classList.add('hidden');
                }

    </script>
<?php endif; ?>

<style>
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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