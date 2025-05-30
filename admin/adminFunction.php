<?php 
include("../database/conn.php");

class admin{
  private $conn;
  
  public function __construct($connection){
    $this->conn = $connection;

}

public function createEvent(array $data, array $file): array {
        $response = ['success' => false, 'message' => ''];

        try {
            // Collect values
            $eventName = $data['eventName'] ?? '';
            $eventDate = $data['eventDate'] ?? '';
            $eventStartTime = $data['eventstartTime'] ?? '';
            $eventEndTime = $data['eventendTime'] ?? '';
            $eventType = $data['eventType'] ?? '';
            $eventLocation = $data['eventLocation'] ?? '';
            $eventDescription = $data['eventDescription'] ?? '';
            $ticketPrice = $data['ticketPrice'] ?? 0;
            $ticketQuantity = $data['ticketQuantity'] ?? 0;

            // Upload image and get filename
            $eventImage = $this->handleImageUpload($file['eventImage']);
            if (!$eventImage) {
                $response['message'] = 'Invalid or no image uploaded.';
                return $response;
            }

            // Prepare and bind
            $stmt = $this->conn->prepare("INSERT INTO events 
                (event_name, event_image, event_date, event_start_time, event_end_time, event_type, event_location, event_description, ticket_price, ticket_quantity)
                VALUES 
                (:event_name, :event_image, :event_date, :event_start_time, :event_end_time, :event_type, :event_location, :event_description, :ticket_price, :ticket_quantity)");

            $stmt->bindParam(':event_name', $eventName);
            $stmt->bindParam(':event_image', $eventImage);
            $stmt->bindParam(':event_date', $eventDate);
            $stmt->bindParam(':event_start_time', $eventStartTime);
            $stmt->bindParam(':event_end_time', $eventEndTime);
            $stmt->bindParam(':event_type', $eventType);
            $stmt->bindParam(':event_location', $eventLocation);
            $stmt->bindParam(':event_description', $eventDescription);
            $stmt->bindParam(':ticket_price', $ticketPrice);
            $stmt->bindParam(':ticket_quantity', $ticketQuantity);

            if ($stmt->execute()) {
                $response['success'] = true;
         
            } else {
                $response['message'] = 'Database insert failed.';
            }

        } catch (PDOException $e) {
            $response['message'] = 'Error: ' . $e->getMessage();
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
        $valid_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

        if (!in_array(strtolower($imgExtension), $valid_extensions)) {
            return false;
        }

        $newFileName = rand(1000, 1000000) . "." . $imgExtension;
        $upload_dir = 'upload/';
        move_uploaded_file($file_tmp, $upload_dir . $newFileName);

        return $newFileName;
    }
public function deleteEvent($eventId) {
    try {
        // Step 1: Get the event image name from database
        $stmt = $this->conn->prepare("SELECT event_image FROM events WHERE event_id = :event_id");
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event && isset($event['event_image'])) {
            $imagePath = 'upload/' . $event['event_image'];

            // Step 2: Delete the image file if it exists
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Step 3: Delete the event record from the database
        $stmt = $this->conn->prepare("DELETE FROM events WHERE event_id = :event_id");
        $stmt->bindParam(':event_id', $eventId);
        
        return $stmt->execute(); // Return true if successful

    } catch (PDOException $e) {
        return false;
    }
}

public function editEvent(array $data, array $file): array {
    $response = ['success' => false, 'message' => ''];

    try {
        // Collect values
        $eventId = $data['eventId'] ?? null;
        $eventName = $data['eventName'] ?? '';
        $eventDate = $data['eventDate'] ?? '';
        $eventStartTime = $data['eventStartTime'] ?? '';
        $eventEndTime = $data['eventEndTime'] ?? '';
        $eventType = $data['eventType'] ?? '';
        $eventLocation = $data['eventLocation'] ?? '';
        $eventDescription = $data['eventDescription'] ?? '';
        $ticketPrice = $data['ticketPrice'] ?? 0;
        $ticketQuantity = $data['ticketQuantity'] ?? 0;

        if (!$eventId) {
            $response['message'] = 'Invalid event ID.';
            return $response;
        }

        // Fetch current event to get existing image name
        $stmt = $this->conn->prepare("SELECT event_image FROM events WHERE event_id = :event_id");
        $stmt->bindParam(':event_id', $eventId);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            $response['message'] = 'Event not found.';
            return $response;
        }

        $currentImage = $event['event_image'];

        // Handle image upload if new file provided
        if (isset($file['eventImage']) && $file['eventImage']['error'] === UPLOAD_ERR_OK) {
            $newImage = $this->handleImageUpload($file['eventImage']);

            if (!$newImage) {
                $response['message'] = 'Invalid image uploaded.';
                return $response;
            }

            // Delete old image file
            $oldImagePath = 'upload/' . $currentImage;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $eventImageToUse = $newImage;
        } else {
            // No new image uploaded, keep current image
            $eventImageToUse = $currentImage;
        }

        // Prepare update statement
        $stmt = $this->conn->prepare("UPDATE events SET event_name = :event_name, event_image = :event_image, event_date = :event_date,
    event_start_time = :event_start_time, event_end_time = :event_end_time, event_type = :event_type, event_location = :event_location,
    event_description = :event_description, ticket_price = :ticket_price, ticket_quantity = :ticket_quantity WHERE event_id = :event_id
        ");

        // Bind params
        $stmt->bindParam(':event_name', $eventName);
        $stmt->bindParam(':event_image', $eventImageToUse);
        $stmt->bindParam(':event_date', $eventDate);
        $stmt->bindParam(':event_start_time', $eventStartTime);
        $stmt->bindParam(':event_end_time', $eventEndTime);
        $stmt->bindParam(':event_type', $eventType);
        $stmt->bindParam(':event_location', $eventLocation);
        $stmt->bindParam(':event_description', $eventDescription);
        $stmt->bindParam(':ticket_price', $ticketPrice);
        $stmt->bindParam(':ticket_quantity', $ticketQuantity);
        $stmt->bindParam(':event_id', $eventId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Event updated successfully.';
        } else {
            $response['message'] = 'Database update failed.';
        }
    } catch (PDOException $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }

    return $response;
}

public function getAllUser() {
    try {
        $stmt = $this->conn->prepare("CALL GetAllUsers()");
        $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
       
       
    } catch (PDOException $e) {
        // Handle error gracefully
        echo "Error fetching users: " . $e->getMessage();
        return [];
    }
}

public function deleteUser($userId){
    try{
   $stmt = $this->conn->prepare("SELECT profile_image FROM user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event && isset($event['profile_image'])) {
            $imagePath = '/userPage/upload/' . $event['profile_image'];

            // Step 2: Delete the image file if it exists
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Step 3: Delete the event record from the database
        $stmt = $this->conn->prepare("DELETE FROM user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        
        return $stmt->execute(); // Return true if successful

    } catch (PDOException $e) {
        return false;
    }
}
public function getAllTransactions() {
    try {
        $stmt = $this->conn->prepare("SELECT * FROM transaction_view ORDER BY order_date DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching transactions: " . $e->getMessage();
        return [];
    }
}

}
?>