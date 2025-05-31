    <?php
    include("../database/conn.php");
class user{
    
    private $conn;
    public function __construct($connection){
        $this->conn = $connection;
    }
    public function registerUser($fname, $lname, $email, $password){
        try{
           

            $stmt = $this->conn->prepare("INSERT INTO user (first_name, last_name, email, password, account_created) VALUES (:fName, :lName, :email, :password, NOW())");
            $stmt->bindParam(':fName', $fname);
            $stmt->bindParam(':lName', $lname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if($stmt->execute()){
                return "success";
            }else{
                return "Registration failed. Please try again.";
            }       
        }catch(PDOException $e){
            return "Error: ".$e->getMessage();
        }
    }
        public function emailExists($email) {
        
        try{   
            $check= $this->conn->prepare ("SELECT * FROM user WHERE email =:email");
        $check->bindParam(':email', $email);
        $check->execute();
        return $check->rowCount()>0;
        
        
        }catch(PDOException $e){
            error_log("Database error: " . $e->getMessage());  
            return false; 
        }
    }
    public function login($email, $password){
        try{

            $stmt = $this->conn->prepare("SELECT *FROM user WHERE email = :email AND password = :password");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
           
            if($stmt->rowCount()>0){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $user['role'] = 'user';
                return $user;

            }
            
            $stmt= $this->conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                error_log("Admin found: ".print_r($admin, true)); 
                $admin['role'] = 'admin';
                return $admin;
                
            }
         
            

            }catch(PDOException $e){
            return null;
        }
    }


}





    ?>