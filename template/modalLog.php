<!--log in -->
<?php if(($successLog) && $successLog):?>
    <div id="successModal" class="bg-[rgba(0,0,0,0.4)] w-screen h-screen fixed top-0  z-50 flex justify-center pt-40">
        <div class="bg-white rounded-[10px] w-[20.75rem] h-[12.75rem] items-center flex flex-col relative">
            
       
            <img src="/public/image/check.png" alt="Check" class="mt-8">
            <h1 class="font-bold text-2xl text-gray-900 mx-10 text-center mt-2">
                Log in <span class="text-[#10B484]">Successful</span>!
            </h1>
            <p class="text-black font-light text-md ">Welcome <?php echo isset($message) ? '<span class="text-[#10b484]">'.$message.'</span>' :'';?>!</p>
        </div>
    </div>

    <script>

           setTimeout(function() {
        <?php if (isset($_SESSION ['user'] ['role']) && $_SESSION['user'] ['role'] === 'admin'): ?> window.location.href = '../admin/dashboardAdmin.php';
        <?php else: ?>
                window.location.href = '../userPage/dashboardUser.php';
        <?php endif;?>
               }, 3000);   


            function closeModal() {
                document.getElementById('successModal').classList.add('hidden');
            }
    </script>
<?php endif;?>

<!--log in failed -->

<?php if(($failedLog) && $failedLog):?>
    <div id="successModal" class="bg-[rgba(0,0,0,0.4)] w-screen h-screen fixed top-0  z-50 flex justify-center pt-40">
        <div class="bg-white rounded-[10px] w-[20.75rem] h-[12.75rem] items-center flex flex-col relative">
    

            <img src="/public/image/x.png" alt="Check" class="mt-8">
            <h1 class="font-bold text-2xl text-gray-900 mx-10 text-center mt-2">
                     Log in <span class="text-[#e2382f]">Failed</span>!
            </h1>
            <p class="text-[#e2382f] text-center text-md pt-1 font-light"><?php echo($message)?></p>
        </div>
    </div>




    <script>

           setTimeout(function() {
        window.location.href = 'login.php';
    }, 3000);   
           
            function closeModal() {
                document.getElementById('successModal').classList.add('hidden');
            }
    </script>
<?php endif;?>



