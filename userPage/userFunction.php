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
        $stmt = $this->conn->prepare("    SELECT * FROM events
    ORDER BY (event_date = CURDATE() AND event_start_time >= CURTIME()) DESC, 
(event_date > CURDATE() OR (event_date = CURDATE() AND event_start_time > CURTIME())) DESC, event_date ASC, event_start_time ASC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
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
}

?>