<?php 

    class DBcontroller {
        public $server_name;
        public $username;
        public $password;
        public $database;
        public $conn;

        function __construct() {
            $this->server_name = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->database = "librarysystem"; 
            $this->conn;
        }

        public function openConnection() {
            $this -> conn = new mysqli($this -> server_name, $this -> username, $this -> password, $this -> database); // Create connection
            if ($this -> conn -> connect_error) {
                echo "Error in Connection : " . $this -> conn -> connect_error;
                return false;
            } else {
                return true;
            }
        }

        public function closeConnection() {
            if ($this -> conn) {
                $this -> conn -> close();
            } else {
                echo "Connection Isn't Opened";
            }
        }

        public function select($qry) {
            $result = $this -> conn -> query($qry);
            if (!$result) {
                echo "Error : " . mysqli_error($this -> conn);
                return false;
            } else {
                
                return $result -> fetch_all(MYSQLI_ASSOC);
            }
        }
        

        public function insert($qry){
            if ($this->conn->query($qry)===false) {
                throw new Exception("Error: " . $this->conn->error);
            } else {
                return true;
            }
        }


        public function update($qry){
            if (!$this->conn->query($qry)) {
                throw new Exception("Error: " . $this->conn->error);
            } else {
                return true;
            }
        }

        public function delete($qry){
            if (!$this->conn->query($qry)) {
                throw new Exception("Error: " . $this->conn->error);
            } else {
                return true;
            }
        }   
        
    }
