<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >DNSC Events</title>
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
    <h1 class="text-white font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl lg:-mt-20 md:-mt-20 text-center">Welcome to DNSC Events Ticket System</h1>
    <p class="text-white font-extralight  sm:text-lg tmd:text-xl lg:text-2xl mt-2 text-center lg:mx-35 md:mx-35 m-1 ">Book tickets for school events, seminars, and activities all in one place, anytime, anywhere</p>
    <div class="flex items-center justify-center space-x-4 mt-4">
    <button type="button" class="text-white p-2 px-6 bg-[#009332] font-light cursor-pointer hover:bg-[#007A2A] transition text-sm sm:text-base md:text-md lg:text-md ">Book Now!</button>
    <button type="button" class="text-black p-2 px-6 bg-white font-light cursor-pointer hover:bg-gray-200 transition text-sm sm:text-base md:text-md lg:text-md ">Sign up</button>
    </div> 

</div>
<div class="grid grid-cols-1  md:grid-cols-2  lg:grid-cols-4 gap-2 mx-4 mt-8">
  <div class="lg:flex-row md:flex-row flex flex-col items-center  justify-center text-center lg:text-left md:text-left ">
    
    <img src="/public/image/browse.png" alt="" class="mr-3">
   <div>
    <h1 class="text-black font-bold text-2xl">Browse <span class="text-[#009332]">Ticket</span></h1>
    
    <p class="text-black font-regular">Easily find upcoming events and check details.</p>
    </div>
  </div>

  <div class="lg:flex-row md:flex-row flex flex-col  items-center justify-center lg:text-left md:text-left text-center ">
    <img src="/public/image/buy.png" alt="" class="mr-3">
    <div>
    <h1 class="text-black font-bold text-2xl">Buy<span class="text-[#009332]">Ticket</span></h1>
    
    <p class="text-black font-regular">Quickly purchase tickets online with a few clicks.</p>
    </div>
  </div>

  <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left">
    <img src="/public/image/view.png" alt="" class="mr-3">
    <div>
    <h1 class="text-black font-bold text-2xl">View <span class="text-[#009332]">Ticket</span></h1>
    
    <p class="text-black font-regular">Keep track of all your tickets in one place. </p>
    </div>
  </div>

  <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left ">
    <img src="/public/image/update.png" alt="" class="mr-3">
    <div>
    <h1 class="text-black font-bold text-2xl">Stay <span class="text-[#009332]">Updated</span></h1>
    
    <p class="text-black font-regular">Receive updates about your events and ticket status.</p>
    </div>
  </div>
</div>

<div class="text-center mt-20 flex flex-col items-center justify-center">
  <div class="relative inline-block">
    <h1 class="text-black font-bold text-3xl">
      Our <span class="text-[#009332]">Events</span>
    </h1>
  

  <p class="text-black font-normal mt-5 text-xl ">
    Discover memorable moments and upcoming experiences you won't want to miss.
  </p>
</div>


<div class="flex flex-col  
justify-center items-center gap-6  mt-4 lg:flex-row md:gap-6">
  <div class="bg-white rounded-2xl shadow-xl p-4 w-100 h-145">
    
    <img 
      class="m-1 h-100 w-full object-cover rounded-lg" 
      src="/public/image/dnscBg.png" 
      alt="Tall Image"
    >
    
    <div class="mt-4">
      <h2 class="text-xl font-bold text-black mb-2">Card Title</h2>
      <p class="text-gray-600 text-sm mb-4">
        A short description below the tall and narrow image.
      </p>
        <div class="flex justify-end">
      <button class="px-4 py-2 mt-2 bg-[#009332] text-white rounded-lg hover:bg-[#007A2A] transition cursor-pointer">
        Purchase
      </button>
      </div>

    </div>

  </div>

  <div class="bg-white rounded-2xl shadow-xl p-4 w-100 h-145">
    
    <img 
      class="m-1 h-100 w-full object-cover rounded-lg" 
      src="/public/image/dnscBg.png" 
      alt="Tall Image"
    >
    
    <div class="mt-4">
      <h2 class="text-xl font-bold text-black mb-2">Card Title</h2>
      <p class="text-gray-600 text-sm mb-4">
        A short description below the tall and narrow image.
      </p>
      <div class="flex justify-end">
      <button class="px-4 py-2 mt-2 bg-[#009332] text-white rounded-lg hover:bg-[#007A2A]transition cursor-pointer">
        Purchase
      </button>
      </div>
    </div>

  </div>

  <div class="bg-white rounded-2xl shadow-xl p-4 w-100 h-145">
    
    <img 
      class="m-1 h-100 w-full object-cover rounded-lg" 
      src="/public/image/dnscBg.png" 
      alt="Tall Image"
    >
    
    <div class="mt-4">
      <h2 class="text-xl font-bold text-black mb-2">Card Title</h2>
      <p class="text-gray-600 text-sm mb-4">
        A short description below the tall and narrow image. 
      </p>
      <div class="flex justify-end">
      <button class="px-4 py-2 mt-2 bg-[#009332] text-white rounded-lg hover:bg-[#007A2A] transition cursor-pointer">
        Purchase
      </button>
      </div>
    </div>

  </div>
</div>


<div class="flex flex-col lg:flex-row items-center justify-center mt-10 lg:mt-40 mx-5 lg:mx-20">
  <img src="/public/image/aboutDsnc.jpg" alt="About DNSC" 
       class="rounded-[10px] h-80 w-80 md:h-110 md:w-110 lg:h-130 lg:w-130 mb-5 lg:mb-0 lg:mr-10 lg:ml-20">
  
  <div class="text-center lg:text-left">
    <p class="text-lg text-[#009332] font-bold">ABOUT US</p>
    <h1 class="text-black font-bold text-2xl mt-2">Davao del Norte State College</h1>
    <p class="text-black font-normal text-lg text-justify max-w-2xl mt-4">
      Davao del Norte State College (DNSC) is a respected higher education institution in Mindanao, known for its academic excellence, strong community involvement, and commitment to innovation. Recognized by the Commission on Higher Education (CHED) as a Center of Excellence in Fisheries Education, DNSC has continuously provided quality programs in fields such as Information Technology, Education, Agriculture, Public Administration, and Environmental Science.
    </p>
  </div>
</div>
<div class="flex flex-col lg:flex-row justify-center lg:justify-start items-center mt-40">
  <div class="lg:ml-40 text-center lg:text-left w-full">
    
    <h1 class="text-black font-bold text-3xl">
      Ticket <span class="text-[#009332]">Selection</span>
    </h1>
 
    <!--kulang underline-->
    
    <p class="text-black font-light text-lg lg:max-w-160 justify-center lg:text-justify text-center  mt-3
     ">
      User-friendly interface for selecting tickets, including options for quantity, pricing details, and provides event-specific options such as date or time selection.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-5 md:mt-2 justify-center  lg:mr-4 lg:mx-0 mx-5">
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 rounded-[10px]">
        <h1 class="text-white font-bold text-xl">Easy Ticket Selection</h1>
        <p class="text-white font-light text-lg mt-1">Select your desired tickets with ease and convenience</p>
      </div>
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 rounded-[10px]">
        <h1 class="text-white font-bold text-xl">Event-Specific Option</h1>
        <p class="text-white font-light text-lg mt-1">Customize your ticket experience with flexible options.</p>
      </div>
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 rounded-[10px]">
        <h1 class="text-white font-bold text-xl">Transparent Pricing Details</h1>
        <p class="text-white font-light text-lg mt-1">View clear pricing information to make informed ticket purchases</p>
      </div>
    </div>

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
