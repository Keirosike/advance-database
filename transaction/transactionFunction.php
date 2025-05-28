<?php 
include("../database/conn.php");

class Transaction{
    private $conn;

    public function __construct($connection){
        $this->conn = $connection;
    }


public function purchaseTicket( $user_id, $event_id, $quantity, $price_per_ticket) {
    $total_price = $quantity * $price_per_ticket;
    $order_date = date('Y-m-d H:i:s');
   
    $ticket_code = uniqid('TCKT-');

    $stmt = $this->conn->prepare("INSERT INTO ticket_purchase (user_id, event_id, quantity, total_price, order_date, ticket_code)
            VALUES (:user_id, :event_id, :quantity, :total_price, :order_date, :ticket_code)");
    return $stmt->execute([
        ':user_id' => $user_id,
        ':event_id' => $event_id,
        ':quantity' => $quantity,
        ':total_price' => $total_price,
        ':order_date' => $order_date,
        ':ticket_code' => $ticket_code
    ]);
}

}
?>