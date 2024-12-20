<?php
require_once('main.php');
$main = new Main();

$array = [];
if (isset($_GET["AnotherPageBookID"])) {
    $array = $main->readBook($_GET["AnotherPageBookID"]); 
}

if (isset($_POST["BookData"])) {
    $bookID = $_POST["bookID"];
    $bookData = $main->readBook($bookID);
    $_SESSION["cart"] = array_merge($_SESSION["cart"] ?? [], $bookData);
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
            <div class="big_book">
                <div class="LD">
                    <img src="<?php echo isset($array[0]['image']) ? $array[0]['image'] : 'test.png'; ?>" alt="<?php echo htmlspecialchars($array[0]['name'] ?? 'Book'); ?>">
                </div>
                <form method="POST" action="index.php">
                    <div class="RD">
                        <h3><?php echo htmlspecialchars($array[0]['name'] ?? 'Unknown Book'); ?></h3>
                        <p><strong>Price: $</strong> <?php echo htmlspecialchars($array[0]['price'] ?? 'N/A'); ?></p>
                        <button type="submit" class="add-to-cart" name="BookData">Add to Cart</button>
                        <h3>Description:</h3>
                        <p><?php echo htmlspecialchars($array[0]['info'] ?? 'No description available.'); ?></p>
                        <ul class="book-meta">
                        <input type="hidden" name="bookID" value="<?php echo htmlspecialchars($array[0]['id']); ?>">
                        <li><strong>Category:</strong> <?php echo htmlspecialchars($array[0]['category'] ?? 'Uncategorized'); ?></li>
                        </ul>
                    </div>
                </form>
                
            </div>
        </main>
    </div>
    <div id="content">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
