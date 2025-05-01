<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/src/output.css">
</head>
<body>
    

<?php include('../template/navbar.php')?>

<div class="w-full relative mt-15">
  <img src="/public/image/dnsc1.png" alt="" class="w-full h-50 lg:h-40 object-cover">

  <!-- Text Content -->
  <div class="absolute lg:top-1/2 lg:left-20 lg:transform lg:-translate-y-1/2 flex flex-col top-1/2 left-1/2 transform -translate-y-1/2 text-center lg:text-left lg:-translate-x-0 w-full -translate-x-1/2 px-4">
    <h1 class="text-white text-2xl lg:text-3xl font-bold">Don't Miss Our Upcoming Events!</h1>
    <p class="text-white text-base lg:text-lg font-light mt-2">Book your tickets today and join the fun!</p>
    
    <!-- Buttons - Vertical on mobile, horizontal on desktop -->
    <div class="flex  justify-center space-x-3 mt-4 lg:hidden">
      <button class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer text-sm">Book Now</button>
      <button class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer text-sm">Sign up</button>
    </div>
  </div>

  <!-- Buttons - Horizontal (Desktop only) -->
  <div class="absolute lg:top-1/2 lg:right-10 lg:transform lg:-translate-y-1/2 hidden lg:flex space-x-4">
    <button class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer">Book Now</button>
    <button class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer">Sign up</button>
  </div>
</div>


</body>
</html>