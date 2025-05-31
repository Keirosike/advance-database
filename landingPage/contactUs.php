<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png">
    <style>
      
    </style>
</head>
<body class="font-primary">
    <!-- Navbar would be included here -->
  <?php include('../template/navbar.php');?> 

    <div class="bg-[url('/public/image/bg-login.png')] bg-cover bg-no-repeat bg-center min-h-[93vh] md:h-[95.5vh] lg:h-[92vh] flex items-center justify-center py-10 px-4">
        <!-- container -->
        <div class="flex flex-col md:flex-row w-full max-w-[50rem] min-h-[35rem] mb-0 md:mb-20 shadow-xl/20 rounded-[50px]">
            <!--color green left side-->
           <!--color green left side-->
<div class="bg-[#009332] md:w-1/2 lg:rounded-l-[50px] md:rounded-t-none rounded-t-[50px] md:rounded-l-[50px] flex items-center justify-center p-8">
    <div class="w-full max-w-[18rem] text-center">
        <h1 class="text-2xl text-white font-bold">Contact DNSC Events</h1>
        <p class="text-sm text-white font-light mt-2">We'd love to hear from you!</p>
        <div class="mt-6 text-white text-sm text-left">
            <p class="flex items-start mb-3 break-words">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span class="break-words">dnscevents@gmail.com</span>
            </p>
            <p class="flex items-start mb-3 break-words">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span class="break-words">09914314749</span>
            </p>
            <p class="flex items-start break-words">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="break-words">Davao del Norte State College, Panabo City</span>
            </p>
        </div>
    </div>
</div>


            <!-- contact form right side -->   
            <div class="bg-white md:w-1/2 lg:rounded-r-[50px] rounded-b-[50px] md:rounded-l-none md:rounded-r-[50px] items-center flex flex-col py-8 px-4">
                <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="w-16 h-16 md:w-20 md:h-20">
                <h1 class="text-xl font-bold text-black pt-4">Contact <span class="text-[#009332]">Us</span></h1>
                
                <form action="#" method="POST" class="w-full max-w-[18rem] mt-4">
                    <input type="text" name="name" placeholder="Your Name" required 
                        class="w-full h-[2.125rem] rounded-[10px] border-1 pl-3 text-sm border-[#009332] mt-2 focus:outline-none focus:border-[#009332]">
                    
                    <input type="email" name="email" placeholder="Your Email" required 
                        class="w-full h-[2.125rem] rounded-[10px] text-sm border-1 pl-3 mt-3 border-[#009332] focus:outline-none focus:border-[#009332]">
                    
                    <input type="text" name="subject" placeholder="Subject" required 
                        class="w-full h-[2.125rem] rounded-[10px] text-sm border-1 pl-3 mt-3 border-[#009332] focus:outline-none focus:border-[#009332]">
                    
                    <textarea name="message" placeholder="Your Message" rows="5" required
                        class="w-full rounded-[10px] text-sm border-1 pl-3 mt-3 pt-2 border-[#009332] focus:outline-none focus:border-[#009332]"></textarea>
                    
                    <button type="submit" 
                        class="bg-[#009332] w-full h-[2.125rem] rounded-[10px] text-white text-sm mt-3 cursor-pointer hover:bg-[#007A2A] transition-colors duration-300">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>

   
   <?php include('../template/footer.php');?>
</body>
</html>