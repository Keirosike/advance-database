<?php
include("../database/conn.php");
include("../userPage/userFunction.php");

$user = new user($conn);

$events = $user->showEvent();





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png">
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            width: 100%;
            overflow-x: clip;
        }
        .container-bound {
            max-width: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body class="font-primary">

    <?php include('../template/navbar.php')?>

    <!-- Main content container with overflow protection -->
    <div class="container-bound">
        <div class="bg-[linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('/public/image/dnscBg.png')] bg-cover w-full bg-center bg-no-repeat h-[50vh] sm:h-[60vh] md:h-[80vh] lg:h-[92vh] flex items-center justify-center flex-col px-4">
            <h1 class="text-white font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl lg:-mt-20 md:-mt-20 text-center">Welcome to DNSC Events Ticket System</h1>
            <p class="text-white font-extralight sm:text-lg tmd:text-xl lg:text-2xl mt-2 text-center lg:mx-35 md:mx-35 m-1">Book tickets for school events, seminars, and activities all in one place, anytime, anywhere</p>
            <div class="flex items-center justify-center space-x-4 mt-4">
                <a href="./login.php" class="text-white p-2 px-6 bg-[#009332] font-light cursor-pointer hover:bg-[#007A2A] transition text-sm sm:text-base md:text-md lg:text-md">Book Now!</a>
                <a href="./signup.php" class="text-black p-2 px-6 bg-white font-light cursor-pointer hover:bg-gray-200 transition text-sm sm:text-base md:text-md lg:text-md">Sign up</a>
            </div>
        </div>

        <div class="grid grid-cols-1 w-full md:grid-cols-2 lg:grid-cols-4 gap-1 mt-4 px-4 mx-auto">
            <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left">
                <img src="/public/image/browse.png" alt="" class="mr-3">
                <div>
                    <h1 class="text-black font-bold text-2xl">Browse <span class="text-[#009332]">Ticket</span></h1>
                    <p class="text-black font-regular">Easily find upcoming events and check details.</p>
                </div>
            </div>   

            <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center lg:text-left md:text-left text-center">
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
                    <p class="text-black font-regular">Keep track of all your tickets in one place.</p>
                </div>
            </div>

            <div class="lg:flex-row md:flex-row flex flex-col items-center justify-center text-center lg:text-left md:text-left">
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
                <p class="text-black font-normal mt-1 text-xl">
                    Discover memorable moments and upcoming experiences you won't want to miss.
                </p>
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 pt-8">
                    <?php
if ($events && count($events) > 0) {
    $count = 0;
    foreach ($events as $event) {
        if ($count >= 3) break; // ⛔ Stop after 3 events

        $eventDate = date('M d, Y', strtotime($event['event_date']));
        $startTime = date('g:i A', strtotime($event['event_start_time']));
        $endTime = date('g:i A', strtotime($event['event_end_time']));
        $eventDateTime = strtotime($event['event_date'] . ' ' . $event['event_start_time']);
        
        $eventName = htmlspecialchars($event['event_name']);
        $eventType = htmlspecialchars($event['event_type']);
        $eventLocation = htmlspecialchars($event['event_location']);
        $ticketPrice = $event['ticket_price'] == 0 ? "Free" : "₱" . number_format($event['ticket_price'], 2);
        $eventImage = htmlspecialchars($event['event_image']);
        $eventId = (int)$event['event_id'];
        $eventDescription = htmlspecialchars($event['event_description'] ?? 'No description available');
        
        // Determine if event is past
        $isPast = time() > $eventDateTime;
        $statusClass = $isPast ? "bg-gray-100 text-gray-800" : "bg-green-100 text-green-800";
?>
<div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden event-card"
    data-category="<?php echo $eventType; ?>"
    data-location="<?php echo $eventLocation; ?>"
    data-date="<?php echo date('Y-m-d', strtotime($event['event_date'])); ?>"
    data-start-time="<?php echo $startTime; ?>"
    data-end-time="<?php echo $endTime; ?>"
    data-search="<?php echo strtolower($eventName . ' ' . $eventType . ' ' . $eventLocation); ?>"
    data-description="<?php echo $eventDescription; ?>"
    data-ticket-quantity="<?= $event['ticket_quantity'] ?>"
    >

    <img src="/admin/upload/<?php echo $eventImage; ?>" 
        alt="<?php echo $eventName; ?>" 
        class="w-full h-60 md:h-80 object-cover" 
        loading="lazy">
    <div class="p-3 md:p-4">
        <div class="flex justify-between items-start mb-1 md:mb-2">
            <h3 class="font-bold text-base md:text-lg"><?php echo $eventName; ?></h3>
            <span class="<?php echo $statusClass; ?> text-xs px-2 py-1 rounded-full event-type">
                <?php echo $eventType; ?>
            </span>
        </div>
        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-2 md:mb-3">
            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="event-location"><?php echo $eventLocation; ?></span>
        </div>
        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
            <svg class="h-3 w-3 md:h-4 md:w-4 mr-1" aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="event-date"><?php echo $eventDate; ?></span> 
            <span class="separator">&nbsp; • &nbsp;</span> 
            <span><?php echo $startTime; ?></span>
        </div>
        <div class="flex items-center text-gray-600 text-xs md:text-sm mb-3 md:mb-4">
            <span><?php echo $ticketPrice; ?></span>
        </div>

        <a 
           href="./login.php" class="block w-full bg-[#009332] hover:bg-[#007A2A] text-white text-center py-1 md:py-2 rounded-md md:rounded-lg transition focus:outline-none focus:ring-2 focus:ring-[#009332] focus:ring-offset-2 view-details-btn cursor-pointer"
            data-event-id="<?php echo $eventId; ?>">
            View Details
        </a>
    </div>
</div>
<?php
        $count++; // ✅ increment count
    }
} else {
    echo '<div class="col-span-full text-center py-8 text-gray-500">No events found.</div>';
}
?>


              
                    
                    <div id="about-us"></div>
                </div>
            </div>
        </div>

        <section>
            <div class="flex flex-col lg:flex-row items-center justify-center mt-10 lg:mt-40 mx-5 lg:mx-20">
                <img src="/public/image/aboutDsnc.jpg" alt="About DNSC" 
                    class="rounded-[10px] h-auto max-w-full md:max-w-[440px] lg:max-w-[520px] mb-5 lg:mb-0 lg:mr-10 lg:ml-10">
                
                <div class="text-center lg:text-left">
                    <p class="text-lg text-[#009332] font-bold">ABOUT US</p>
                    <h1 class="text-black font-bold text-2xl mt-2">Davao del Norte State College</h1>
                    <p class="text-black font-normal text-lg text-justify max-w-2xl mt-4">
                        Davao del Norte State College (DNSC) is a respected higher education institution in Mindanao, known for its academic excellence, strong community involvement, and commitment to innovation. Recognized by the Commission on Higher Education (CHED) as a Center of Excellence in Fisheries Education, DNSC has continuously provided quality programs in fields such as Information Technology, Education, Agriculture, Public Administration, and Environmental Science.
                    </p>
                </div>
            </div>
        </section>

        <div class="flex flex-col lg:flex-row justify-center lg:justify-start items-center mt-40 px-4">
            <div class="lg:ml-40 text-center lg:text-left w-full">
                <h1 class="text-black font-bold text-3xl">
                    Ticket <span class="text-[#009332]">Selection</span>
                </h1>
                
                <p class="text-black font-light text-lg lg:max-w-160 justify-center lg:text-justify text-center mt-3">
                    User-friendly interface for selecting tickets, including options for quantity, pricing details, and provides event-specific options such as date or time selection.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5 md:mt-2 justify-center lg:mr-4 lg:mx-0 mx-3">
                    <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4">
                        <h1 class="text-white font-bold text-xl">Easy Ticket Selection</h1>
                        <p class="text-white font-light text-lg mt-1">Select your desired tickets with ease and convenience</p>
                    </div>
                    <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4">
                        <h1 class="text-white font-bold text-xl">Event-Specific Option</h1>
                        <p class="text-white font-light text-lg mt-1">Customize your ticket experience with flexible options.</p>
                    </div>
                    <div class="w-full h-28 bg-[#007A2A] flex flex-col justify-center p-4">
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
                
                <div class="flex justify-center space-x-3 mt-4 lg:hidden">
                    <a href="./login.php" class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer text-sm">Book Now</a>
                    <a href="./signup.php" class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer text-sm">Sign up</a>
                </div>
            </div>

            <div class="absolute lg:top-1/2 lg:right-10 lg:transform lg:-translate-y-1/2 hidden lg:flex space-x-4">
                <a href="./login.php" class="px-4 py-2 bg-[#009332] text-white font-light hover:bg-[#007A2A] transition cursor-pointer">Book Now</a>
                <a href="./signup.php" class="px-4 py-2 bg-white text-black font-light hover:bg-gray-200 transition cursor-pointer">Sign up</a>
            </div>
        </div>
    </div>

    <?php include('../template/footer.php')?>
</body>
</html>