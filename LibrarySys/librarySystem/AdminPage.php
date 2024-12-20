<?php
require_once('main.php');
$main = new Main();
if (isset($_SESSION["user"]) && is_array($_SESSION["user"]) && isset($_SESSION["user"][1]) && $_SESSION["user"][1] == 1) {
   
}else{
    header("Location: index.php");
}


$books = $main->DB->select("SELECT * FROM book");
$users = $main->ShowAllUsers();
$orders = $main->DB->select("select 
qnatity,
date,
book,
order_details.ordid,
user.name,
user.location,
user.phone_number
from order_details join order_master on order_details.ordid=order_master.ordid join user on Userid=user.id;");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_book'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $info = $_POST['info'];
        $category = $_POST['category'];
        $image = $_FILES['image']['name'];
        $image_path = "ImageDB/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

        $main->DB->insert("INSERT INTO book (name, price, info, category, image) VALUES ('$name', $price, '$info', '$category', '$image_path')");
        header("Location: AdminPage.php");
    }

    if (isset($_POST['update_book'])) {
        $book_id = $_POST['book_id'];
        $price = $_POST['price'];
        $info = $_POST['info'];
        $category = $_POST['category'];

        $main->DB->update("UPDATE book SET price = $price, info = '$info', category = '$category' WHERE id = $book_id");
        header("Location: AdminPage.php");
    }

    if (isset($_POST['update_user'])) {
        $user_id = $_POST['user_id'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $location = $_POST['location'];

        $main->DB->update("UPDATE user SET email = '$email', age = $age, location = '$location' WHERE id = $user_id");
        header("Location: AdminPage.php");
    }

    if (isset($_POST['user_delete'])) {
        $user_id = $_POST['userID'];
        $main->DeleteUser($user_id);
        header("Location: AdminPage.php");
    }
    
    if (isset($_POST['book_delete'])) {
        $book_id = $_POST['bookID'];
        $main->DeleteBook($book_id);
        header("Location: AdminPage.php");
    }
    if((isset($_POST["order_delete"]))){
        $order_id=$_POST['orderid'];
        $main->DeleteOrders($order_id);
        header("Location: AdminPage.php");
    }



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div id="content">
            <?php include 'header.php'; ?>
        </div>
    <div class="main-content_admin">

        <div class="a_item">
            <h2>Available Books</h2>
            <ul>
                <?php foreach ($books as $book): ?>
                <li>
                    <h3><?php echo htmlspecialchars($book['Name']); ?></h3>
                    <p>Price: <?php echo htmlspecialchars($book['price']); ?></p>
                    <p>ID: <?php echo htmlspecialchars($book['id']); ?></p>
                    <p>Category: <?php echo htmlspecialchars($book['category']); ?></p>
                    <p><?php echo htmlspecialchars($book['info']); ?></p>
                    <?php echo "~";?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="a_item">
            <h2>All Users</h2>
            <ul>
                <?php foreach ($users as $user): ?>
                <li>
                    <p>ID: <?php echo htmlspecialchars($user['id']); ?></p>
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <p>Age: <?php echo htmlspecialchars($user['age']); ?></p>
                    <p>Location: <?php echo htmlspecialchars($user['location']); ?></p>
                    <?php echo "~";?>

                </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <div class="a_item">
            <h2>Add a New Book</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="name">Book Name:</label><br>
                <input type="text" name="name" required><br>
                <label for="price">Price:</label><br>
                <input type="number" name="price" required><br>
                <label for="info">Description:</label><br>
                <textarea name="info" required></textarea><br>
                <label for="category">Category:</label><br>
                <input type="text" name="category" required><br>
                <label for="image">Upload Image:</label><br>
                <input  type="file" name="image" required>
                <button class="admin-button" type="submit" name="add_book">Add Book</button>
            </form>
        </div>

        <div class="a_item">
            <h2>All Orders</h2>
            <ul>
                <?php foreach ($orders as $order): ?>
                <li>
                    <p>Order ID: <?php echo htmlspecialchars($order['ordid']); ?></p>
                    <p>Books: <?php echo htmlspecialchars($order['book']); ?></p>
                    <p>Name: <?php echo htmlspecialchars($order['name']); ?></p>
                    <p>Phone: <?php echo htmlspecialchars($order['phone_number']); ?></p>
                    <p>Location: <?php echo htmlspecialchars($order['location']); ?></p>
                    <p>Quantity: <?php echo htmlspecialchars($order['qnatity']); ?></p>
                    <p>Date: <?php echo htmlspecialchars($order['date']); ?></p>

                    <?php echo "~";?>

                </li>
                
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="a_item">
            <h2>Update Book</h2>
            <form method="POST">
                <label for="book_id">Book ID:</label><br>
                <input type="number" name="book_id" required><br>
                <label for="price">Price:</label><br>
                <input type="number" name="price" required><br>
                <label for="info">Description:</label><br>
                <textarea name="info" required></textarea><br>
                <label for="category">Category:</label><br>
                <input type="text" name="category" required><br>
                <button  class="admin-button" type="submit" name="update_book">Update Book</button>
            </form>
        </div>

        <div class="a_item">
            <h2>Update User Data</h2>
            <form method="POST">
                <label for="user_id">User ID:</label><br>
                <input type="number" name="user_id" required><br>
                <label for="email">Email:</label><br>
                <input type="email" name="email" required><br>
                <label for="age">Age:</label><br>
                <input type="number" name="age" required><br>
                <label for="location">Location:</label><br>
                <input type="text" name="location" required><br>
                <button class="admin-button" type="submit" name="update_user">Update User</button>
            </form>
        </div>
        <div class="a_item">
            <h2>Delete user</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="userID" required>
                <button  class="admin-button" type="submit" name="user_delete">Delete User</button>
            </form>
        </div>
            <div class="a_item">
                <h2>Delete book</h2>
                <form method="POST" enctype="multipart/form-data">
                <input type="text" name="bookID" required>
                <button class="admin-button" type="submit" name="book_delete">Delete Book</button>
                </form>
            </div>


            <div class="a_item">
                <h2>Delete Order</h2>
                <form method="POST" enctype="multipart/form-data">
                <input type="text" name="orderid" required>
                <button class="admin-button" type="submit" name="order_delete">Delete Order</button>
                </form>
            </div>


    </div>
    <div id="content">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
