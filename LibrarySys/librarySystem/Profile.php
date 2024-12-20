<?php 
require_once('main.php');
$main = new Main();
if (isset($_SESSION["user"])) {
    $data = $main->getUserData($_SESSION['user'][2]);
}else{
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/css.css">
</head>
<body>
    <div id="content">
        <?php include 'header.php'; ?>
    </div>
    <div class="content">
        <main class="main-content">
            <h1>User Profile</h1>
            <div class="user-profile">
                <?php
                if (!empty($data)) {
                    $user = $data[0]; 
                    echo "<p><strong>Name:</strong> " . htmlspecialchars($user['name']) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
                    echo "<p><strong>Age:</strong> " . htmlspecialchars($user['age']) . "</p>";
                    echo "<p><strong>Location:</strong> " . htmlspecialchars($user['location']) . "</p>";
                    echo "<p><strong>Phone Number:</strong> " . htmlspecialchars($user['phone_number']) . "</p>";
                    echo "<p><strong>Admin Status:</strong> " . ($user['isAdmin'] ? 'Yes' : 'No') . "</p>";
                } else {
                    echo "<p>No user data available.</p>";
                }
                ?>
            </div>
        </main>
    </div>
    <div id="content">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
