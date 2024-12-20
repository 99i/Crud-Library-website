<?php
require_once("auth.php");
if(isset($_SESSION["user"])){
    $_SESSION["user"]=null;
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

<div class="content">
    <main class="Logincontent">
        <div class="RegDiv">
            <form method="post" action="auth.php">
            <h2>Register</h2>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <button class="filter-btn" type="submit" name="register">Register</button>
            </form>
        </div>

        <div class="LogDiv">
        <form method="post" action="auth.php">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button class="filter-btn" type="submit" name="login">Login</button>
            </form>
        </div>

    </main>
</div>

<div id="content">
    <?php include 'footer.php'; ?>
</div>
</body>
</html>
