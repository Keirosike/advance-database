<?php
include("../database/conn.php");
include ("./adminFunction.php");
session_start();

$admin = new admin($conn);
$getAllUser = $admin->getAllUser();

$successDeleteUser = false;
$failedDeleteUser = false;

if (isset($_POST['confirmDeleteUserBtn'])) {
    $userId = $_POST['user_id'] ?? null;
    if ($userId) {
        $deleted = $admin->deleteUser($userId);

        if ($deleted) {
            $successDeleteUser = true;
          
        } else {
            $failedDeleteUser = true;
           $message = "Failed to delete user.";
        }
    } else {
        $failedDeleteUser = true;
        $message = "No user ID provided.";
    }
}
        include("./deleteUserLog.php");

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNSC Events - User Management</title>
    <link rel="stylesheet" href="/src/output.css">
    <link rel="icon" href="/public/image/dnscLogo.png" class="w-5 h-5" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-primary bg-gray-100 min-h-screen">
    <?php include("../template/navbarAdmin.php");?>
 
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header with Create Button -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manage <span class="text-[#009332]">Users</span></h1>
                    <p class="text-gray-600">View and manage all system users</p>
                </div>
               
            </div>

            <!-- Filters and Search -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <!-- Role Filter -->
                        <div>
                            <label for="role-filter" class="sr-only">Role</label>
                            <select id="role-filter" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Roles</option>
                                <option value="admin">Admin</option>
                                <option value="faculty">Faculty</option>
                                <option value="student">Student</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        
                        <!-- Status Filter -->
                        <div>
                            <label for="status-filter" class="sr-only">Status</label>
                            <select id="status-filter" class="text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#009332]">
                                <option value="all">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending">Pending</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Search -->
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Search users..." class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-[#009332]">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
     <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    User
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Contact
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Last Active
                </th><th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Account Created 
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
     <tbody class="bg-white divide-y divide-gray-200" id="usersTableBody">
    <?php if (!empty($getAllUser)): ?>
        <?php foreach ($getAllUser as $user): ?>
            <tr id="user-row-<?= htmlspecialchars($user['user_id']) ?>" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full object-cover" 
                               src="<?= !empty($user['profile_image']) ? '/userPage/upload/'.$user['profile_image'] : '/public/image/user.png' ?>" 
                                 alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                <?= htmlspecialchars($user['full_name']) ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        <?= htmlspecialchars($user['email']) ?>
                    </div>
                    <div class="text-sm text-gray-500">
                        <?= htmlspecialchars($user['contact_number']?? 'N/A') ?>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?php
                        $statusColor = match ($user['status']) {
                            'Active' => 'green',
                            'Inactive' => 'gray',
                            'Pending' => 'yellow',
                            'Suspended' => 'red',
                            default => 'gray',
                        };
                    ?>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-<?= $statusColor ?>-100 text-<?= $statusColor ?>-800">
                        <?= htmlspecialchars($user['status']) ?>
                    </span>
                </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= htmlspecialchars($user['last_active']?? 'N/A'); ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= htmlspecialchars($user['account_created']) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <button class="text-red-600 hover:text-red-900 cursor-pointer" title="Delete" 
                            onclick="confirmDeleteUser(<?= htmlspecialchars($user['user_id']) ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center py-4 text-gray-500">
                No users found.
            </td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>
</div> 
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">4</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 opacity-50 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                
                                <a href="#" class="bg-[#009332] text-white relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium">
                                    1
                                </a>
                                
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 opacity-50 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   



   
<?php include("confirmDeleteUser.php");?>
       
   
</body>
</html>