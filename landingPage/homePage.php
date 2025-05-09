      <!DOCTYPE html>
      <html lang="en">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title >DNSC Events</title>
          <link rel="stylesheet" href="/src/output.css">
      </head>
      <body class="font-primary overflow-x-hidden ">

     <?php include('../template/navbar.php')?>


      <div class="bg-[linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('/public/image/dnscBg.png')] bg-cover w-full bg-center  bg-no-repeat h-[50vh]  sm:h-[60vh] md:h-[80vh] lg:h-[92.5vh] flex items-center justify-center flex-col  max-w-full ">
          <h1 class="text-white font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl lg:-mt-20 md:-mt-20 text-center">Welcome to DNSC Events Ticket System</h1>
          <p class="text-white font-extralight sm:text-lg tmd:text-xl lg:text-2xl mt-2 text-center lg:mx-35 md:mx-35 m-1">Book tickets for school events, seminars, and activities all in one place, anytime, anywhere</p>
          <div class="flex items-center justify-center space-x-4 mt-4">
              <button type="button" class="text-white p-2 px-6 bg-[#009332] font-light cursor-pointer hover:bg-[#007A2A] transition text-sm sm:text-base md:text-md lg:text-md">Book Now!</button>
              <button type="button" class="text-black p-2 px-6 bg-white font-light cursor-pointer hover:bg-gray-200 transition text-sm sm:text-base md:text-md lg:text-md">Sign up</button>
          </div>
      </div>



      
    <div class="grid grid-cols-1 w-full md:grid-cols-2  lg:grid-cols-4 gap-1 mt-4  max-w-full ">
        <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left  ">
          
          <img src="/public/image/browse.png" alt="" class="mr-3">
        <div>
          <h1 class="text-black font-bold text-2xl">Browse <span class="text-[#009332]">Ticket</span></h1>
          
          <p class="text-black font-regular">Easily find upcoming events and check details.</p>
          </div>
        </div>   

        <div class="lg:flex-row md:flex-row flex flex-col  items-center justify-center lg:text-left md:text-left text-center">
          <img src="/public/image/buy.png" alt="" class="mr-3">
          <div>
          <h1 class="text-black font-bold text-2xl">Buy<span class="text-[#009332]">Ticket</span></h1>
          
          <p class="text-black font-regular">Quickly purchase tickets online with a few clicks.</p>
          </div>
        </div>

        <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left ">
          <img src="/public/image/view.png" alt="" class="mr-3">
          <div>
          <h1 class="text-black font-bold text-2xl">View <span class="text-[#009332]">Ticket</span></h1>
          
          <p class="text-black font-regular">Keep track of all your tickets in one place. </p>
          </div>
        </div>

        <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left  ">
          <img src="/public/image/update.png" alt="" class="mr-3">
          <div>
          <h1 class="text-black font-bold text-2xl">Stay <span class="text-[#009332]">Updated</span></h1>
          
          <p class="text-black font-regular">Receive updates about your events and ticket status.</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-20 flex flex-col items-center justify-center">
  
      <div class="container">
    <h1 class="text-black font-bold text-3xl">
      Our <span class="text-[#009332]">Events</span>
    </h1>
  

  <p class="text-black font-normal mt-1  text-xl ">
    Discover memorable moments and upcoming experiences you won't want to miss.
  </p>
</div>

<div class="max-w-6xl mx-auto px-4">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    
    
    <div class="bg-white rounded-[10px] shadow-md overflow-hidden flex flex-col">
      <div class="px-4 pt-4 "> 
        <img class="w-full h-100 object-cover rounded-[10px]" src="/public/image/dnscBg.png" alt="Card Image 1" />
      </div>
      <div class="p-4 flex-grow text-left">
        <h2 class="text-xl font-semibold mb-2">Card Title 1</h2>
        <p class="text-gray-600 text-sm mb-4">This is a short description for card number one.</p>
        <div class="flex justify-end">
          <button class="bg-[#009332] hover:bg-[#007A2A] text-white font-medium py-2 px-4 rounded-[10px] text-sm transition duration-300">
          Purchase
          </button>
        </div>
      </div>
    </div>

    
    <div class="bg-white rounded-[10px] shadow-md overflow-hidden flex flex-col">
      <div class="px-4 pt-4"> 
        <img class="w-full h-100 object-cover rounded-[10px]" src="/public/image/dnscBg.png" alt="Card Image 2" />
      </div>
      <div class="p-4 flex-grow text-left ">
        <h2 class="text-xl font-semibold mb-2">Card Title 2</h2>
        <p class="text-gray-600 text-sm mb-4">This is a short description for card number two.</p>
        <div class="flex justify-end">
          <button class="bg-[#009332] hover:bg-[#007A2A] text-white font-medium py-2 px-4 rounded-[10px] text-sm transition duration-300">
          Purchase
          </button>
        </div>
      </div>
    </div>

   
    <div class="bg-white rounded-[10px] shadow-md overflow-hidden flex flex-col">
      <div class="px-4 pt-4   "> 
        <img class="w-full h-100 object-cover rounded-[10px]" src="/public/image/dnscBg.png" alt="Card Image 3" />
      </div>
      <div class="p-4 flex-grow text-left">
        <h2 class="text-xl font-semibold mb-2">Card Title 3</h2>
        <p class="text-gray-600 text-sm mb-4">This is a short description for card number three.</p>
        <div class="flex justify-end">
          <button class="bg-[#009332] hover:bg-[#007A2A] text-white font-medium py-2 px-4 rounded-[10px] text-sm transition duration-300">
            Purchase
          </button>
        </div>
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5 md:mt-2 justify-center  lg:mr-4 lg:mx-0 mx-3">
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 ">
        <h1 class="text-white font-bold text-xl">Easy Ticket Selection</h1>
        <p class="text-white font-light text-lg mt-1">Select your desired tickets with ease and convenience</p>
      </div>
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 ">
        <h1 class="text-white font-bold text-xl">Event-Specific Option</h1>
        <p class="text-white font-light text-lg mt-1">Customize your ticket experience with flexible options.</p>
      </div>
      <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4 ">
        <h1 class="text-white font-bold text-xl">Transparent Pricing Details</h1>
        <p class="text-white font-light text-lg mt-1">View clear pricing information to make informed ticket purchases</p>
      </div>
    </div>

  </div>
</div>
<div class="w-full relative mt-15">
  <img src="/public/image/dnsc1.png" alt="" class="w-full h-50 lg:h-40 object-cover">


  <div class="absolute lg:top-1/2 lg:left-20 lg:transform lg:-translate-y-1/2 flex flex-col top-1/2 left-1/2 transform -translate-y-1/2 text-center lg:text-left lg:-translate-x-0 w-full -translate-x-1/2 px-4">
    <h1 class="text-white text-2xl lg:text-3xl font-bold">Don't Miss Our Upcoming Events!</h1>
    <p class="text-white text-base lg:text-lg font-light mt-2">Book your tickets today and join the fun!</p>
    
 
    <div class="flex  justify-center space-x-3 mt-4 lg:hidden">
      <button class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer text-sm">Book Now</button>
      <button class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer text-sm">Sign up</button>
    </div>
  </div>

 
  <div class="absolute lg:top-1/2 lg:right-10 lg:transform lg:-translate-y-1/2 hidden lg:flex space-x-4">
    <button class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer">Book Now</button>
    <button class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer">Sign up</button>
  </div>
</div>

<?php include('../template/footer.php')?>
      
      
      
      
      



      <script>
          const hamburgerIcon = document.getElementById('hamburger-icon');
          const mobileMenu = document.getElementById('mobile-menu');

          hamburgerIcon.addEventListener('click', () => {
              mobileMenu.classList.toggle('hidden');
          });
      </script>

      </body>
      </html>
