<?php 
include('../database/conn.php');
class user{

  private $conn;

  public function __construct($connection){
    $this->conn = $connection;
  }

public function showEvent($page = 1, $perPage = 8) {
    try {
        $offset = ($page - 1) * $perPage;

        $stmt = $this->conn->prepare("
            SELECT * FROM events
            ORDER BY
                -- First, prioritize upcoming events (0 for future, 1 for past)
                CASE 
                    WHEN event_date > CURDATE() THEN 0
                    WHEN event_date = CURDATE() AND event_start_time >= CURTIME() THEN 0
                    ELSE 1
                END ASC,
                -- Then sort upcoming events by soonest date/time
                event_date ASC,
                event_start_time ASC
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

public function countEvents() {
    try {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM events");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    } catch(PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}


public function showEventInDashboard(){
    try{

        $stmt = $this->conn->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC, event_start_time ASC LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

public function getUserByID($userId){
    try{
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = :userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}



public function myTicket($userId, $page = 1, $itemsPerPage = 5) {
    try {
        $offset = ($page - 1) * $itemsPerPage;
        
        $stmt = $this->conn->prepare("
            SELECT 
                tp.*, 
                e.event_image,
                e.event_name, 
                e.event_location, 
                e.event_date, 
                e.event_start_time,
                e.event_end_time,
                CONCAT(u.first_name, ' ', u.last_name) AS full_name,  
                u.email AS user_email
            FROM ticket_purchase tp
            INNER JOIN events e ON tp.event_id = e.event_id
            INNER JOIN user u ON tp.user_id = u.user_id
            WHERE tp.user_id = :userId
            ORDER BY tp.order_date DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        // Get total count for pagination
        $countStmt = $this->conn->prepare("
            SELECT COUNT(*) as total 
            FROM ticket_purchase 
            WHERE user_id = :userId
        ");
        $countStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        return [
            'tickets' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total
        ];
    } catch(PDOException $e) {
        error_log("Database error in myTicket: " . $e->getMessage());
        return [
            'tickets' => [],
            'total' => 0
        ];
    }
}
public function deleteTicket($user_id, $ticket_id) {
    // Verify ticket belongs to user
    $stmt = $this->conn->prepare("SELECT user_id FROM ticket_purchase WHERE ticket_id = :ticket_id");
    $stmt->execute([':ticket_id' => $ticket_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return false; // Ticket doesn't exist
    }

    if ($row['user_id'] != $user_id) {
        return false; // Ticket doesn't belong to this user
    }

    // Delete the ticket
    $stmt = $this->conn->prepare("DELETE FROM ticket_purchase WHERE ticket_id = :ticket_id");
    $stmt->execute([':ticket_id' => $ticket_id]);

    // Check if any rows were deleted
    if ($stmt->rowCount() > 0) {
        return true; // Deleted successfully
    } else {
        return false; // No rows deleted
    }
}



public function profile($user_id) {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle the error gracefully
        echo "Database error: " . $e->getMessage();
        return false;
    }
}
public function editProfile($user_id, $firstName, $lastName, $email, $studentId, $contactNumber, $imageFile) {
    try {
        // Handle optional image upload
        $imagePath = null;
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $imageName = uniqid() . '_' . basename($imageFile['name']);
            $imagePath = $uploadDir . $imageName;

            if (!move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
                throw new Exception("Failed to upload profile image.");
            }
        }

        // Build query based on whether image is uploaded
        if ($imagePath) {
            $sql = "UPDATE user 
                    SET first_name = ?, last_name = ?, email = ?, student_id = ?, contact_number = ?, profile_image = ? 
                    WHERE user_id = ?";
            $params = [$firstName, $lastName, $email, $studentId, $contactNumber, $imagePath, $user_id];
        } else {
            $sql = "UPDATE user 
                    SET first_name = ?, last_name = ?, email = ?, student_id = ?, contact_number = ? 
                    WHERE user_id = ?";
            $params = [$firstName, $lastName, $email, $studentId, $contactNumber, $user_id];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return true;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        return false;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


public function purchase_history($userId, $page = 1, $itemsPerPage = 5) {
    try {
        $offset = ($page - 1) * $itemsPerPage;

        $stmt = $this->conn->prepare("
            SELECT 
                ph.*,
                e.event_name,
                e.event_image,
                e.event_location,
                e.event_date,
                e.event_start_time,
                e.event_end_time,
                e.ticket_price, 
                CONCAT(u.first_name, ' ', u.last_name) AS full_name,
                u.email AS user_email
            FROM purchase_history ph
            INNER JOIN events e ON ph.event_id = e.event_id
            INNER JOIN user u ON ph.user_id = u.user_id
            WHERE ph.user_id = :userId
            ORDER BY ph.order_date DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Get total count for pagination
        $countStmt = $this->conn->prepare("
            SELECT COUNT(*) as total 
            FROM purchase_history 
            WHERE user_id = :userId
        ");
        $countStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $countStmt->execute();
        $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        return [
            'history' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total
        ];
    } catch(PDOException $e) {
        error_log("Database error in purchase_history: " . $e->getMessage());
        return [
            'history' => [],
            'total' => 0
        ];
    }
}
public function updateUserProfile($userId, array $data, array $file): array {
    $response = ['success' => false, 'message' => ''];

    try {
        $firstName = $data['first_name'] ?? '';
        $lastName = $data['last_name'] ?? '';
        $contactNumber = $data['contact_number'] ?? '';
        $studentId = $data['student_id'] ?? '';

        // Validate required fields if needed
        if (!$firstName || !$lastName) {
            $response['message'] = 'First name and last name are required.';
            return $response;
        }

        // Handle optional image upload
        $profileImage = null;
        if (isset($file['profile_image']) && $file['profile_image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $profileImage = $this->handleImageUpload($file['profile_image']);
            if (!$profileImage) {
                $response['message'] = 'Invalid profile image.';
                return $response;
            }
        }

        // Build SQL dynamically depending on whether image is uploaded
        if ($profileImage) {
            $sql = "UPDATE user 
                    SET first_name = :first_name, last_name = :last_name, contact_number = :contact_number, student_id = :student_id, profile_image = :profile_image 
                    WHERE user_id = :user_id";
        } else {
            $sql = "UPDATE user 
                    SET first_name = :first_name, last_name = :last_name, contact_number = :contact_number, student_id = :student_id 
                    WHERE user_id = :user_id";
        }

        $stmt = $this->conn->prepare($sql);

        // Bind common params
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':contact_number', $contactNumber);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':user_id', $userId);

        // Bind image param if needed
        if ($profileImage) {
            $stmt->bindParam(':profile_image', $profileImage);
        }

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Failed to update user profile.';
        }

    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }

    return $response;
}


public function handleImageUpload($image) {
    if (!isset($image) || $image['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $file_name = $image['name'];
    $file_tmp = $image['tmp_name'];
    $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);
    $valid_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($imgExtension), $valid_extensions)) {
        return false;
    }

    $newFileName = uniqid() . "." . $imgExtension;
    $upload_dir = 'upload/';

    if (!move_uploaded_file($file_tmp, $upload_dir . $newFileName)) {
        return false;
    }

    return $newFileName;
}

public function showEventProfile(){
    try{

        $stmt = $this->conn->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC, event_start_time ASC LIMIT 2");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        error_log("Database error: " . $e->getMessage());
        return false;
    }

}

public function hasOrderedTicket($eventId, $userId){
      
    try{
    $stmt = $this->conn->prepare("SELECT * FROM ticket_purchase WHERE event_id = ? AND user_id = ?");
    $stmt->execute([$eventId, $userId]);
    return $stmt->rowCount() > 0;
}catch(PDOException $e){
}
}
public function showPastEvent() {
    try {
        $today = date("Y-m-d"); // Get today's date

        $stmt = $this->conn->prepare("SELECT * FROM events 
                                      WHERE event_date < ? 
                                      ORDER BY event_date DESC");
        $stmt->execute([$today]);

        $pastEvents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
       

        return $pastEvents;
    } catch (PDOException $e) {
        // Handle exception
        return [];
    }
}
public function showFirstName(){
  $user_id = $_SESSION['user']['user_id'];
try {
    $stmt = $this->conn->prepare("SELECT first_name FROM user WHERE user_id = ?");
    
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $first_name = $user ? $user['first_name'] : 'User';

} catch (PDOException $e) {
 
    $first_name = 'User';
}
  return $first_name; 
}

public function countTicketPurchases($userId) {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM purchase_history WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

public function sumTotalSpent($userId) {
    $stmt = $this->conn->prepare("SELECT SUM(total_price) FROM purchase_history WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn() ?: 0;
}

public function countEventsAttended($userId) {
    $stmt = $this->conn->prepare("SELECT COUNT(DISTINCT event_id) FROM purchase_history WHERE user_id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}

public function sumPendingPayments($userId) {
    $stmt = $this->conn->prepare("SELECT SUM(total_price) FROM purchase_history WHERE user_id = ? AND status = 'Pending'");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn() ?: 0;
}



public function showEvents($page = 1, $perPage = 3) {
    try {
        $stmt = $this->conn->prepare("CALL showEvent(:page, :perPage)");
        $stmt->bindValue(':page', $page, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();

           return $stmt->fetchAll(PDO::FETCH_ASSOC);
     

 
    } catch (PDOException $e) {
        echo "Error fetching users: " . $e->getMessage();
        return [];
    }
}



}
?>