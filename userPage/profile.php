<?php
include("../database/conn.php");
include("./userFunction.php");
session_start();
$user_id = $_SESSION['user']['user_id'];

$user = new user($conn); // Pass PDO connection to the class
$profileData = $user->profile($user_id);
$event = $user->showEventProfile();
$events = $user->showPastEvent(); 

$successEditProfile = false;
$failedEditProfile = false;
$message='';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
    $userId = $_POST['user_id'] ?? null;

    if ($userId) {
        $response = $user->updateUserProfile($userId, $_POST, $_FILES);

       if ($response['success']) {
            $successEditProfile = true;
        } else {
            $failedEditProfile = true;
        }
        $message = $response['message'];
        include('./successEditProfile.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events - My Profile</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media (max-width: 768px) {
            .profile-header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            .profile-avatar-container {
                margin-top: -4rem;
                margin-bottom: 1rem;
            }
            .profile-actions {
                width: 100%;
                margin-top: 1rem;
            }
            .profile-actions button {
                width: 100%;
            }
        }
        
        /* Enhanced styles */
        
        
        .event-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .event-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: #009332;
        }
        
        .table-row-hover:hover {
            background-color: #f8fafc;
        }
        
        .avatar-edit-btn {
            transition: all 0.2s ease;
        }
        
        .avatar-edit-btn:hover {
            transform: scale(1.1);
            background-color: #e5e7eb !important;
        }
    </style>
</head>
<body class="font-primary bg-gray-50 min-h-screen">
    <!-- Navbar placeholder -->
     <?php include("../template/navbarUser.php");?>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Enhanced Profile Header -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class=" bg-[#009332] h-40 md:h-48  flex justify-center items-center"> <img src="/public/image/dnscLogo.png" alt="" class="h-30 w-auto"> </div>
            <div class="px-6 pt-2 sm:px-8 pb-8 relative">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between profile-header-content ">
                    <div class="flex items-end -mt-20 profile-avatar-container">
                    <div class="relative group">
    <img src="<?= !empty($profileData['profile_image']) ? 'upload/'.$profileData['profile_image'] : '/public/image/user.png' ?>" 
         alt="Profile" 
         class="w-28 h-28 md:w-36 md:h-36 rounded-full border-4 border-white object-cover shadow-md">
    <button   onclick="openEditProfileModal()" class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 avatar-edit-btn">
        <i class="fas fa-camera text-gray-600 text-base"></i>
    </button>
</div>
<div class="ml-6 md:ml-8 mb-1 md:mb-2 sm:text-white">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 ">
        <?= htmlspecialchars($profileData['first_name'] . ' ' . $profileData['last_name']) ?>
    </h1>
    <div class="flex items-center mt-1">
        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
            <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full"></span>
            Active
        </span>
        <p class="text-gray-600 text-sm md:text-base ml-3">
            Member since <?= date("F Y", strtotime($profileData['account_created'])) ?>
        </p>
    </div>
</div>

                    </div>
                    <div class="mt-6 md:mt-0 profile-actions flex space-x-3">
                        <button class="cursor-pointer bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg font-medium transition flex items-center">
                            <i class="fas fa-share-alt mr-2"></i>
                            Share
                        </button>
                 
<button 
    onclick="openEditProfileModal()"
    class="bg-[#009332] hover:bg-[#007A2A] text-white px-5 py-2.5 rounded-lg font-medium transition flex items-center cursor-pointer">
    <i class="fas fa-edit mr-2"></i>
    Edit Profile
</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - User Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Enhanced Personal Information Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user-circle mr-3 text-[#009332]"></i>
                            Personal Information
                        </h2>
                    </div>
                    <div class="px-6 py-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-50 flex items-center justify-center">
                                <i class="fas fa-user text-[#009332]"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs text-gray-500">Full Name</p>
                               <p class="font-medium">
        <?= htmlspecialchars($profileData['first_name'] . ' ' . $profileData['last_name']) ?>
    </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-50 flex items-center justify-center">
                                <i class="fas fa-envelope text-[#009332]"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs text-gray-500">Email</p>
                                 <p class="font-medium"><?= htmlspecialchars($profileData['email']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-50 flex items-center justify-center">
                                <i class="fas fa-phone text-[#009332]"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs text-gray-500">Contact Number</p>
                                 <p class="font-medium"><?= htmlspecialchars($profileData   ['contact_number'] ?? 'N/A') ?></p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-50 flex items-center justify-center">
                                <i class="fas fa-id-card text-[#009332]"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-xs text-gray-500">Student ID</p>
                                    <p class="font-medium"><?= htmlspecialchars($profileData   ['student_id'] ?? 'N/A') ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Account Settings Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-cog mr-3 text-[#009332]"></i>
                            Account Settings
                        </h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <a href="#" class="flex items-center px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-green-50 flex items-center justify-center mr-4">
                                <i class="fas fa-lock text-[#009332] text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Change Password</p>
                                <p class="text-xs text-gray-500 mt-1">Update your account password</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                        </a>
                        <a href="#" class="flex items-center px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-green-50 flex items-center justify-center mr-4">
                                <i class="fas fa-bell text-[#009332] text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Notification Settings</p>
                                <p class="text-xs text-gray-500 mt-1">Manage your notification preferences</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                        </a>
                        <a href="../template/logout.php" class="flex items-center px-6 py-4 hover:bg-gray-50 transition">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-green-50 flex items-center justify-center mr-4">
                                <i class="fas fa-sign-out-alt text-[#009332] text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Logout</p>
                                <p class="text-xs text-gray-500 mt-1">Sign out of your account</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column - Events and Tickets -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Enhanced Upcoming Events Card -->
              <div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-calendar-check mr-3 text-[#009332]"></i>
            Upcoming Events
        </h2>
        <a href="./browseEvent.php" class="text-sm text-[#009332] hover:underline flex items-center">
            View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
    </div>
    
    <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <?php
        $events = $user->showEventProfile(); // Fetch events from database
        
        if (!empty($events)) {
            foreach ($events as $event) {
                $eventDate = date("M d, Y", strtotime($event['event_date']));
                $eventTime = date("h:i A", strtotime($event['event_start_time']));
                    $eventTime = date("h:i A", strtotime($event['event_end_time']));
                ?>
                <!-- Dynamic Event Card -->
                <div class="event-card rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="/admin/upload/<?php echo htmlspecialchars($event['event_image']); ?>" 
                             alt="<?php echo htmlspecialchars($event['event_name']); ?>" 
                             class="w-full h-60 object-cover">
                        
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($event['event_name']); ?></h3>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span><?php echo $eventDate; ?> • <?php echo $eventTime; ?></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span><?php echo htmlspecialchars($event['event_location']); ?></span>
                        </div>
                        <div class="flex justify-end items-center">
                            
                            <a href="./browseEvent.php?id=<?php echo $event['event_id']; ?>" 
                               class="text-sm text-white bg-[#009332] hover:bg-[#007A2A] px-8 py-2 rounded transition flex items-center">
                                View <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="text-gray-500 col-span-2 text-center py-8">No upcoming events found.</p>';
        }
        ?>
    </div>
</div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-history mr-3 text-[#009332]"></i>
            Past Events
        </h2>
        <a href="./browseEvent.php" class="text-sm text-[#009332] hover:underline flex items-center">
            View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
        </a>
    </div>
    
    <div class="px-6 py-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $pastEvents = $user->showPastEvent();
                    $userId = $_SESSION['user_id'] ?? 0; // Assuming you have user ID in session
                    
                    if (!empty($pastEvents)) {
                        foreach ($pastEvents as $event) {
                            $eventDate = date("M d, Y", strtotime($event['event_date']));
                            $eventTime = date("h:i A", strtotime($event['event_start_time'])) . ' - ' . date("h:i A", strtotime($event['event_end_time']));
                            $hasTicket = $user->hasOrderedTicket($event['event_id'], $userId);
                            $status = $hasTicket ? 'Attended' : 'No Show';
                            $statusClass = $hasTicket ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                            ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" 
                                                 src="/admin/upload/<?php echo htmlspecialchars($event['event_image'] ?? 'default-event.jpg'); ?>" 
                                                 alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($event['event_name']); ?></div>
                                            <div class="text-xs text-gray-500"><?php echo htmlspecialchars($event['event_category'] ?? 'General'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900"><?php echo $eventDate; ?></div>
                                    <div class="text-xs text-gray-500"><?php echo $eventTime; ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusClass; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" class="px-6 py-4 text-center text-gray-500">No past events found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
<?php include("./editProfileModal.php");?>

</body>
</html>