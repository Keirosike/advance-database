<?php
require_once('../database/conn.php');
require_once('functionLanding.php');
session_start();

$message ='';
$success= false;
$failed = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new user($conn);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format";
        $failed = true;
    } 

    else if ($user->emailExists($email)) {
        $message = "Email already registered";
        $failed = true;
    }

    else {
        $message = $user->registerUser($fName, $lName, $email, $password);
        if ($message == "success") {
            $success = true;
        } else {
            $message = "Registration failed. Please try again.";
            $failed = true;
        }
    }

}


?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DNSC Events</title>
        <link rel="stylesheet" href="/src/output.css">
        <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" >
    </head>
    <body class="font-primary">
   
    <?php include('../template/navbar.php');?>
      

        <div class="bg-[url('/public/image/bg-login.png')] bg-cover bg-no-repeat bg-center min-h-[93vh] md:h-[95.5vh] lg:h-[92vh]   flex items-center justify-center py-10 px-4 ">
            <!-- container -->
            <div class="flex flex-col md:flex-row w-full max-w-[43rem] min-h-[31.25rem] mb-0 md:mb-20 shadow-xl/20 rounded-[50px] ">
              
                
                  
                     <div class="bg-white md:w-1/2 lg:rounded-l-[50px] lg:rounded-r-none  rounded-t-[50px] rounded-b-none md:rounded-r-none md:rounded-l-[50px]   items-center flex flex-col py-8 px-4 white-side">
                    <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="w-16 h-16 md:w-20 md:h-20">
                    <h1 class="text-xl font-bold text-black pt-4">Sign <span class="text-[#009332]">up</span></h1>
                    
                    <form method="POST"class="w-full max-w-[14rem] mt-4">
                    <input type="text" name="fname" placeholder="First Name" id="fname" required 
                    class="w-full h-[2.125rem] rounded-[10px] border-1 pl-3 text-sm border-[#009332] -mt-2 focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                    
                    
                    <input type="text" name="lname" placeholder="Last Name" id="lname" required 
                            class="w-full h-[2.125rem] rounded-[10px] border-1 pl-3 text-sm border-[#009332] mt-2 focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                            <input type="email" name="email" placeholder="Email" id="email" required 
                            class="w-full h-[2.125rem] rounded-[10px] border-1 pl-3 text-sm border-[#009332] mt-2 focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                        
                        <input type="password" name="password" placeholder="Password" id="password" required 
                            class="w-full h-[2.125rem] rounded-[10px] text-sm border-1 pl-3 mt-3 border-[#009332] focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                        
                        <button type="submit" name="signup"
                            class="bg-[#009332] w-full h-[2.125rem] rounded-[10px] text-white text-sm mt-3 cursor-pointer hover:bg-[#007A2A] transition-colors duration-300">
                            Sign up
                        </button>
                        
                        <div class="text-right w-full mt-2">
                            <p class="text-black font-light text-[0.75rem]">
                                Forgot <a href="#" class="text-[#009332] cursor-pointer">Password</a>?
                            </p>
                        </div>
                    </form>
                </div>
                
                
                <div class="bg-[#009332] md:w-1/2 lg:rounded-r-[50px] lg:rounded-l-none  rounded-b-[50px] rounded-t-none lg:rounded-t-[50px]  md:rounded-r-[50px] md:rounded-l-none  items-center justify-center flex flex-col p-8 green-side ">  
                    <h1 class="text-2xl text-white font-bold text-center">Register Now!</h1>
                    <p class="text-sm text-white font-light mt-2 text-center">Already have an account?</p>
                    <button type="submit" class="w-[7rem] h-[2.5rem] border-1 rounded-full border-white text-white font-light cursor-pointer hover:bg-white hover:text-black text-md mt-4 mb-4 md:mb-15 transition-colors duration-300">
                        <a href="login.php">Log in</a>
                    </button>
                </div>

              
            </div>
        </div>
        <?php include('../template/modalReg.php'); ?>
  
    </body>
    </html>