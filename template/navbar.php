    <nav class="bg-white w-full  p-1 shadow-3xl  border-b-1 border-b-gray-200 sticky top-0 z-50 overflow-x-hidden">
        <div class="flex items-center justify-start w-full">
        
        <div class="md:hidden flex items-center  ml-2 mr-4">
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
            <div class="text-black text-lg font-semibold cursor-pointer p-2 flex items-center mr-5">
                <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="h-8 w-8 mr-2">
                <span class="pr-1">DNSC</span>
                <span class="text-[#009332]">Events</span>
            </div>

            <!-- desktop menu -->
            <div class="hidden md:flex mx-3 gap-5 ml-auto">
                <a href="/landingPage/homePage.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Home</a>
                <a href="/landingPage/homePage.php#about-us" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">About</a>
                <a href="/landingPage/contactUs.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Contact us</a>
                <div class="ml-auto flex items-center justify-center bg-[#009332] rounded-full w-25 h-10 cursor-pointer hover:bg-[#007A2A] px-4">
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    if($currentPage == 'login.php') {
                        echo '<a href="/landingPage/signup.php" class="text-white font-regular text-sm">Sign up</a>';
                    } else {
                        echo '<a href="/landingPage/login.php" class="text-white font-regular text-sm">Log in</a>';
                    }
                    ?>
                </div>
            </div>
    
        </div>

    

    <!-- mobile  Sidebar -->
    <div id="mobile-menu" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex justify-end p-4">
            <button id="close-menu" class="text-black focus:outline-none cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex flex-col space-y-4 px-6 py-4">
        <div class="text-black text-lg font-semibold cursor-pointer p-1 flex items-center mr-5">
                    <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="h-8 w-8 mr-2">
                    <span class="pr-1">DNSC</span>
                    <span class="text-[#009332]">Events</span>
                </div>
                    
            <a href="/landingPage/homePage.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded">Home</a>
            <a href="/landingPage/homePage.php#about-us" class="text-black font-regular p-2  hover:bg-gray-100 rounded">About</a>
            <a href="/landingPage/contactUs.php" class="text-black font-regular p-2 hover:bg-gray-100 rounded">Contact</a>
            <div class="flex items-center justify-center bg-[#009332] rounded-full p-2 px-4 hover:bg-[#007A2A] mt-4">
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                if($currentPage == 'login.php') {
                    echo '<a href="/landingPage/signup.php" class="text-white font-regular text-sm">Sign up</a>';
                } else {
                    echo '<a href="/landingPage/login.php" class="text-white font-regular text-sm">Log in</a>';
                }
                ?>
            </div>
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

        // Close menu when clicking on links (optional)
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', toggleMenu);
        });
    </script>