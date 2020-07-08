<?php

    include_once  '../config/database.php';
    
    class info{

        private $conn; 
        private $table = "info";

        public $id;
        public $name;
        public $email;
        public $phone;

        public function __construct($db){
            $this->conn = $db;
        }

        public function read(){
            $query = "SELECT * FROM ". $this->table ."";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create(){
            $query = "INSERT INTO
                        ". $this->table ."
                    SET
                        name = :name, 
                        email = :email, 
                        phone = :phone";

            $stmt = $this->conn->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            
            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function readsingle(){
            $query = "SELECT
                        id, 
                        name, 
                        email,
                        phone
                    FROM
                        ". $this->table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->phone = $dataRow['phone'];
        }        

        public function update(){
            $query = "UPDATE ". $this->table ." 
            SET
                name = :name,
                email = :email,
                phone = :phone
            WHERE
                id = :id";

            $stmt = $this->conn->prepare($query);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()){
                return true;
             }
             return false;
        }
        
        public function delete(){
            $query = "DELETE FROM ". $this->table ." WHERE id = ?";
            $stmt = $this->conn->prepare($query);

            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
    $db = $database->connect();
    $info = new Info($db);
?>
