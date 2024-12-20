<?php
require_once('main.php');
$main = new Main();


$category = $main->ReturnCategory();
$rows = [];

if (isset($_POST["queryBtn"]) && !empty($_POST["query"])) {
    $query = $_POST["query"];
    $rows = $main->SearchForBook($query); 
} else {
    if (isset($_POST["catSearch"])) {
        $selectedCategories = [];

        if (isset($_POST['categories'])) {
            $selectedCategories = $_POST['categories'];
        }

        if (!empty($selectedCategories)) {
            $filteredBooks = [];
            
            foreach ($selectedCategories as $categoryKey) {
                $categoryBooks = $main->ReturnCategoryByName($categoryKey);
                $filteredBooks = array_merge($filteredBooks, $categoryBooks); 
            }

            $filteredBooks = array_map("unserialize", array_unique(array_map("serialize", $filteredBooks)));
            $rows = $filteredBooks;
        } else {
            $rows = $main->showAllBooks();
        }
    } else {
        $rows = $main->showAllBooks();
    }
}



if (isset($_POST["BookData"])) {
    $bookID = $_POST["bookID"];
    $bookData=$main->readBook($bookID);
    $_SESSION["cart"]=array_merge($_SESSION["cart"],$bookData);
    $bookID=null;
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
        <aside class="categories">
            <h2>Categories</h2>
            <form method="POST" action="index.php">
                <?php $index = 0; foreach ($category as $cat): ?>
                    <label class="cat-label">
                        <input type="checkbox" name="categories[]" value="<?php echo htmlspecialchars($cat['category']); ?>">
                        <?php echo htmlspecialchars($cat['category']); ?>
                    </label><br>
                <?php $index++; endforeach; ?>
                <input class="filter-btn"type="submit" name="catSearch" value="Filter Books">
            </form>
        </aside>

        <main class="main-content">
                
            <h2>Available Books</h2>
            <div class="booksHolder">
                
               
                <?php
                if (!empty($rows)) {
                    foreach ($rows as $row):
                ?> 
                <form method="POST" action="index.php">
                <div class="book" >
                    <figure>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" style="max-width: 150px; max-height: 150px;">
                        <figcaption>
                        <h2>
                        <a class="bookNameLink" href="book.php?AnotherPageBookID=<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['Name']); ?>
                        </a>
                    </h2>
                            <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                            <input type="hidden" name="bookID" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <p><?php echo htmlspecialchars($row['category']); ?></p>
                            <button type="submit "class="login-button" name="BookData">Add to Cart</button>
                        </figcaption>
                    </figure>
                    </form>
                </div>
                <?php
                    endforeach;
                } else {
                    echo "<p>no book found.</p>";
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
 