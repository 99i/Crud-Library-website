<?php 
include_once ('DBconnection.php');

class Main {
    public $DB;
 
    function __construct() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->DB = new DBcontroller;
        $this->DB->openConnection();
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    function AddBook($price,$info,$name,$image_name,$category){
        $query = "INSERT INTO book(price,info,name,image,category) values ($price,$info,$name,$image_name,$category)";
        $this->DB->insert($query);
    }
    function ShowAllUsers(){
        $query = "SELECT * from user";
        $result = $this->DB->select($query);
        return json_decode(json_encode($result), true);
    }
    function DeleteUser($id){
        $query = "DELETE FROM user WHERE id=$id;";
        $this->DB->insert($query);
    }
    function DeleteBook($id){
        $query = "DELETE FROM book WHERE id=$id;";
        $this->DB->insert($query);
    }
    function readBook($id) {
        $query = "SELECT id, price, info, name, image, category FROM book WHERE id = $id";
        $result = $this->DB->select($query);
    
        return json_decode(json_encode($result), true);
    }
    function updateBook($id,$price,$info,$name,$image_name,$category) {
        $query = "update book set price=$price,info=$info,name=$name,image=$image_name,category=$category where id=$id";
        $this->DB->update($query);
    }
    function SearchForBook($name){
        $query ="select * from book where Name like '%$name%'";
        $result = $this->DB->select($query);
         return $result;
    }
    function showAllBooks(){
        $query = "select * from book";
        $result = $this->DB->select($query);
         return $result;
    }


    function ReturnCategory(){
        $query ="SELECT DISTINCT category FROM book";
        $result = $this->DB->select($query);
        return $result; 
    }
    function ReturnCategoryByName($category){
        $query ="SELECT * FROM book where category='$category'";
        $result = $this->DB->select($query);
        return $result; 
    }

    function __destruct() {
        $this->DB->closeConnection();
    }

    function SubmitOrder($groupedCart,$userId) {
        foreach ($groupedCart as $item) {
            $qant = $item['quantity'];
            $name = $item['name'];
            $date = date("Y-m-d"); 
    
            $order_query = "INSERT INTO order_master (order_date) VALUES ('$date')";
            $this->DB->insert($order_query);
    
            $orderid = $this->DB->conn->insert_id;
    
            $details_query = "INSERT INTO order_details (qnatity, date, book, Userid, ordid) 
                                VALUES ($qant, '$date', '$name', $userId, $orderid)";
            $this->DB->insert($details_query);
    

        }
    
    }

    public function DisplayCart() {
        echo json_encode($_SESSION["cart"]);
    }
    
    public function Register($email,$password,$age,$isAdmin,$location,$phone_number,$name){
        $query = "SELECT email FROM user WHERE email = '$email'";
        $result =$this->DB->select($query);
        if (count($result)==0) {    
            $query = "INSERT INTO user (email, password, age, isAdmin, location, phone_number, name) 
                VALUES ('$email', '$password', '$age', '$isAdmin', '$location', '$phone_number', '$name')";
            $this->DB->insert($query);
            return true;
        }
        return false;

    }
    public function login($email,$password){     
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result =$this->DB->select($query);
        if (count($result)>=1) {
            $username=$result[0]["name"];
            $isAdmin=$result[0]["isAdmin"];
            $id=$result[0]["id"];
            if ($password==$result[0]['password']) {
                return [$username,$isAdmin,$id];   
            } else {
            return false;    
            }
        } 
        return false;
    }
    public function DeleteOrders($id) 
    {
        $query = "SELECT * FROM order_master WHERE ordid = '$id'";
        $result =$this->DB->select($query);
        if (count($result)>=1) {
            $delete_details_query = "DELETE FROM order_details WHERE ordid = $id";
            $this->DB->delete($delete_details_query);
    
            $delete_order_query = "DELETE FROM order_master WHERE ordid = $id";
            $this->DB->delete($delete_order_query);
        } 
        return false;
        
    }
    function getUserData($id){
        $query = "SELECT * FROM user WHERE id = '$id'";
        return $this->DB->select($query);

    }

}


?>