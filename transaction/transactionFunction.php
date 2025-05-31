<?php 
include("../database/conn.php");

class Transaction{
    private $conn;

    public function __construct($connection){
        $this->conn = $connection;
    }


public function purchaseTicket($user_id, $event_id, $quantity, $payment_method) {
    $stmt = $this->conn->prepare("CALL purchase_ticket(:user_id, :event_id, :quantity, :payment_method, @result)");
    
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
    
    $stmt->execute();
    
    // Get result
    $result = $this->conn->query("SELECT @result AS result")->fetch(PDO::FETCH_ASSOC);
    return $result['result'];  // 'Success' or 'Not enough tickets available'
}

}

?>