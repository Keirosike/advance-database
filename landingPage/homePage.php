<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="stylesheet" href="/src/output.css">
</head>
<body class="font-primary">

<nav class="bg-white p-1 mt-1.5   shadow-lg   ">
    <div class="flex items-center justify-between ">
        
        <div class="text-black text-lg font-semibold cursor-pointer p-2 mx-3">
            <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="inline-block h-8 w-8 mr-1"> DNSC </span> <span class="text-[#009332]">Events</span>
        </div>

     
        <div class="hidden md:flex space-x-6 mx-3">
            <a href="#" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Home</a>
            <a href="#" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">About</a>
            <a href="#" class="text-black font-regular p-2 rounded-full px-6 hover:bg-[#009332] hover:text-white transition">Contact us</a>
            <div class="flex items-center justify-center bg-[#009332] rounded-full p-2 px-6 cursor-pointer hover:bg-[#007A2A]">
                <a href="#" class="text-white font-regular text-sm">Log in</a>
            </div>
           
        </div>
        

        <!-- Hamburger Icon (Mobile version) -->
        <div class="md:hidden flex items-center ml-auto">
            <button id="hamburger-icon" class="text-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu-->
    <div id="mobile-menu" class="hidden sm:hidden flex flex-col space-y-4 mt-4">
        <a href="#" class="text-black font-regular">Home</a>
        <a href="#" class="text-black font-regular">About</a>
        <a href="#" class="text-black font-regular">Contact us</a>
        <div class="flex items-center justify-center bg-[#009332] rounded-full p-2 px-4">
                <a href="#" class="text-white font-regular text-sm">Log in</a>
            </div>
    </div>
</nav>


<div class="bg-[linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('/public/image/dnscBg.png')] bg-cover bg-center bg-no-repeat h-[50vh] rounded-b-[10px] mx-5  sm:h-[60vh] md:h-[80vh] lg:h-[90vh] flex items-center justify-center flex-col">
    <h1 class="text-white font-bold text-5xl -mt-20">Welcome to DNSC Events Ticket System</h1>
    <p class="text-white font-extralight text-2xl mt-2 text-center mx-35 ">Book tickets for school events, seminars, and activities all in one place, anytime, anywhere</p>
    <div class="flex items-center justify-center space-x-4 mt-4">
    <button type="button" class="text-white p-2 px-6 bg-[#009332] font-light cursor-pointer hover:bg-[#007A2A] transition">Book Now!</button>
    <button type="button" class="text-black p-2 px-6 bg-white font-light cursor-pointer hover:bg-gray-200 transition">Sign up</button>
    </div> 

</div>

<script>
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburgerIcon.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>
