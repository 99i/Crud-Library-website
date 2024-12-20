<?php
require_once('main.php');
$main = new Main();
$category = $main->ReturnCategory();
$rows = [];

$searchQuery = '';  

if (isset($_POST["queryBtn"]) && !empty($_POST["query"])) {
    $searchQuery = $_POST["query"]; 
    $rows = $main->SearchForBook($searchQuery); 
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
?>

<script src="js/js.js"></script>
<div class="header">
    <img src="webImage/logo.png" alt="Logo">
    <h1>Turki Library</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="AboutUS.php">About</a>
        <a href="contactUS.php">Contact</a>
        <?php
        if (isset($_SESSION["user"]) && is_array($_SESSION["user"]) && isset($_SESSION["user"][1]) && $_SESSION["user"][1] == 1) {
            echo '<a href="AdminPage.php">Admin Page</a>';
        }
        ?>

    </nav>
    <form method="POST" action="index.php">
        <div class="search-bar">
            <?php
               if(isset($_SESSION['user'])){
                    echo'<div class="uIcon">
                    <a href="Profile.php">
                        <img src="webImage/userIcon.png" alt="User Icon">
                    </a>
                </div>';
               }
            ?>
            <input type="text" name="query" placeholder="Search for books..." value="<?php echo htmlspecialchars($searchQuery); ?>" />
            <button type="submit" name="queryBtn">Search</button>
        </div>
    </form>
 
    <div class="search-bar">
                <button class="cart-button" onclick="viewcarts()">View Cart</button>
                <?php
                 if (isset($_SESSION["user"])){
                    echo '<button class="login-button" onclick="viewlogin()">Log out</button>';
                 }else{
                    echo'<button class="login-button" onclick="viewlogin()">Login</button>';
                 }     
                ?>
                
            </div>
 
</div>
