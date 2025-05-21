<nav class="bg-white w-full p-1 shadow-3xl border-b-1 border-b-gray-200 top-0 sticky z-50">
    <div class="flex items-center justify-between w-full"> 
     
        <div class="flex items-center">
            <!-- mobile hamburger icon -->
        <div class="min-[931px]:hidden flex items-center ml-2 mr-4">
        <button id="hamburger-icon" class="text-black focus:outline-none">
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- logo -->
<div class="text-black text-lg font-semibold cursor-pointer p-2 flex items-center">
    <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="h-8 w-8 mr-2">
    <span class="pr-1">DNSC</span>
        <span class="text-[#009332]">Events</span>
    </div>
</div>

       
        <div class="flex items-center">
            <!-- desktop menu -->
            <div class="hidden min-[931px]:flex mx-3 w-full gap-5">
                <a href="/userPage/dashboardUser.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Dashboard</a>
                <a href="/userPage/myTicket.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">My Ticket</a>
                <a href="/userPage/browseEvent.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Browse Event</a>
                <a href="/userPage/purchaseHistory.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Purchase History</a>
                
                <div class="ml-auto pr-3 pt-1 relative">
                    <img id="userBtn" src="/public/image/user1.gif" alt="User" class="w-9 h-9 cursor-pointer">
                    <!-- dropdown menu -->
                    <div id="userDropdown" class="absolute right-4 mt-2 w-32 bg-white rounded-lg shadow-lg hidden z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="../template/logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</a>
                    </div>
                </div>
            </div>

            <!-- mobile user icon -->
            <div class="min-[931px]:hidden flex items-center pr-3 relative">
        <img id="mobileUserBtn" src="/public/image/user1.gif" alt="User" class="w-9 h-9 cursor-pointer">
        <!-- mobile dropdown menu-->
        <div id="mobileUserDropdown" class="absolute right-0 top-full mt-2 w-32 bg-white rounded-lg shadow-xl z-50 hidden ">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Profile</a>
            <a href="../template/logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">Logout</a>
        </div>
    </div>
</div>

    <!-- mobile sidebar -->
    <div id="mobile-menu" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex justify-end p-4">
            <button id="close-menu" class="text-black focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex flex-col space-y-4 px-6 py-1">
            <div class="text-black text-lg font-semibold cursor-pointer p-1 flex items-center mr-5">
                <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="h-8 w-8 mr-2">
                <span class="pr-1">DNSC</span>
                <span class="text-[#009332]">Events</span>
            </div>
         
            <a href="/userPage/dashboardUser.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded flex items-center"><img src="/public/image/dashboard.png" alt="" class="w-5 h-5"> <span class="pl-3">Dashboard</span></a>
            <a href="/userPage/myTicket.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded flex items-center"><img src="/public/image/ticket.png" alt="" class="w-6 h-6"> <span class="pl-3">My Ticket</span></a>
            <a href="/userPage/browseEvent.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded flex items-center"><img src="/public/image/event.png" alt="" class="w-6 h-6"> <span class="pl-3">Browse Event</span></a>
            <a href="/userPage/purchaseHistory.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded flex items-center"><img src="/public/image/purchase.png" alt="" class="w-6 h-6"> <span class="pl-3">Purchase History</span></a>
        </div>
    </div>
    <div id="overlay" class="fixed inset-0 bg-[rgba(0,0,0,0.4)] hidden z-40"></div>
</nav>

<script>
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeMenuBtn = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const overlay = document.getElementById('overlay');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    function toggleMenu() {
        mobileMenu.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        menuIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }

    hamburgerIcon.addEventListener('click', toggleMenu);
    closeMenuBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);

    // close menu when clicking on links
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', toggleMenu);
    });

    // desktop user dropdown
    const userBtn = document.getElementById('userBtn');
    const userDropdown = document.getElementById('userDropdown');

    // mobile user dropdown
    const mobileUserBtn = document.getElementById('mobileUserBtn');
    const mobileUserDropdown = document.getElementById('mobileUserDropdown');

    userBtn.addEventListener('click', () => {
        userDropdown.classList.toggle('hidden');
    });

    mobileUserBtn.addEventListener('click', () => {
        mobileUserDropdown.classList.toggle('hidden');
    });

    // close dropdowns if clicked outside
    document.addEventListener('click', (e) => {
        if (!userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
        if (!mobileUserBtn.contains(e.target) && !mobileUserDropdown.contains(e.target)) {
            mobileUserDropdown.classList.add('hidden');
        }
    });
</script>