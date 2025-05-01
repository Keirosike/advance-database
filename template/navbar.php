<nav class="bg-white w-full p-1 mt-1.5   shadow-lg   ">
        <div class="flex items-center justify-between ">
            
            <div class="text-black text-lg font-semibold cursor-pointer p-2 mx-3">
                <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="inline-block h-8 w-8 mr-1"> DNSC  <span class="text-[#009332]">Events</span>
            </div>

        
            <div class="hidden md:flex space-x-6 mx-3">
                <a href="/landingPage/homePage.php" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Home</a>
                <a href="#" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">About</a>
                <a href="#" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Contact us</a>
                <div class="flex items-center justify-center bg-[#009332] rounded-full p-2 px-6 cursor-pointer hover:bg-[#007A2A]">
                <?php

                $currentPage = basename($_SERVER['PHP_SELF']);

                if($currentPage == 'login.php'){
                    echo '<a href="/landingPage/signup.php" class="text-white font-regular text-sm">Sign up</a>';

                }else{
                    echo '<a href="/landingPage/login.php" class="text-white font-regular text-sm">Log in</a>';
                }

                ?>
                </div>

                
              
            </div>
            

            <div class="md:hidden flex items-center ml-auto">
                <button id="hamburger-icon" class="text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

       
        <div id="mobile-menu" class="hidden sm:hidden flex flex-col space-y-4 mt-4">
            <a href="/landingPage/homePage.php" class="text-black font-regular">Home</a>
            <a href="#" class="text-black font-regular">About</a>
            <a href="#" class="text-black font-regular">Contact </a>
            <div class="flex items-center justify-center bg-[#009332] rounded-full p-2 px-4">
                    <a href="/landingPage/login.php" class="text-white font-regular text-sm">Log in</a>
                </div>
        </div>
    </nav>