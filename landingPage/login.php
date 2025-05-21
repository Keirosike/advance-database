    <?php
require_once('../database/conn.php');
require_once('functionLanding.php');
    session_start();

    $message = "";
    $successLog = false;
    $failedLog = false;



    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)){
            $message = "Please fill in all fields.";
            $failedLog = true;

        }else{
            $user = new user($conn);
            $userAuth = $user->login($email, $password);

            if($userAuth){
                $_SESSION['user'] = $userAuth;
                $fname = $userAuth['first_name'];
                $successLog = true;
                $message = $fname;
                
            }else{
                $failedLog = true;
                $message = 'Invalid email or password.';
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
                <!--color green left side-->
                <div class="bg-[#009332] md:w-1/2 lg:rounded-l-[50px] md:rounded-t-none rounded-t-[50px]  md:rounded-l-[50px]  items-center justify-center flex flex-col p-8 green-side ">  
                    <h1 class="text-2xl text-white font-bold text-center">Welcome Students!</h1>
                    <p class="text-sm text-white font-light mt-2 text-center">Don't have an account?</p>
                    <button class="w-[7rem] h-[2.5rem] border-1 rounded-full border-white text-white font-light cursor-pointer hover:bg-white hover:text-black text-md mt-4 mb-4 md:mb-15 transition-colors duration-300">
                        <a href="signup.php">Sign up</a>
                    </button>
                </div>

                <!-- login form right side -->   
                <div class="bg-white md:w-1/2 lg:rounded-r-[50px]  rounded-b-[50px] md:rounded-l-none md:rounded-r-[50px]   items-center flex flex-col py-8 px-4 white-side">
                    <img src="/public/image/dnscLogo.png" alt="DNSC Logo" class="w-16 h-16 md:w-20 md:h-20">
                    <h1 class="text-xl font-bold text-black pt-4">Log <span class="text-[#009332]">in</span></h1>
                    
                    <form action="" method="POST" class="w-full max-w-[14rem] mt-4">
                        <input type="email" name="email" placeholder="Email" id="email" required 
                            class="w-full h-[2.125rem] rounded-[10px] border-1 pl-3 text-sm border-[#009332] mt-2 focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                        
                        <input type="password" name="password" placeholder="Password" id="password" required 
                            class="w-full h-[2.125rem] rounded-[10px] text-sm border-1 pl-3 mt-3 border-[#009332] focus:outline-none focus:border-[#009332] overflow-hidden text-ellipsis whitespace-nowrap">
                        
                        <button type="submit" name="login" 
                            class="bg-[#009332] w-full h-[2.125rem] rounded-[10px] text-white text-sm mt-3 cursor-pointer hover:bg-[#007A2A] transition-colors duration-300">
                            Log in
                        </button>
                        
                        <div class="text-right w-full mt-2">
                            <p class="text-black font-light text-[0.75rem]">
                                Forgot <a href="#" class="text-[#009332] cursor-pointer">Password</a>?
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include('../template/modalLog.php');?>
    </body>
    </html>