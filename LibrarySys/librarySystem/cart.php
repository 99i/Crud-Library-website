<?php 
require_once('auth.php');
require_once('main.php');
$main = new Main();

$cart = $_SESSION["cart"] ?? [];
$groupedCart = [];

foreach ($cart as $item) {
    $id = $item['id'];
    if (!isset($groupedCart[$id])) {
        $groupedCart[$id] = $item;
        $groupedCart[$id]['quantity'] = 1; 
    } else {
        $groupedCart[$id]['quantity'] += 1;
    }
}
if(isset($_POST["DeleteCart"])){
    $_SESSION=[];
}

if(isset($_POST["submitBtn"])){
    $main->SubmitOrder($groupedCart,$_SESSION["user"][2]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/css.css">
    <script src="js/cart.js"></script>
</head>
<body>
    <div id="content">
        <?php include 'header.php'; ?>
    </div>
    <div class="content">
        <main class="main-content">

            <h2>Shopping Cart:</h2>
            <form method="POST" action="cart.php">
                <?php if (!empty($groupedCart)): ?>
                    <div>
                        <?php 
                        $total = 0;
                        foreach ($groupedCart as $item): 
                            $itemPrice = floatval($item['price']);
                            $itemQuantity = $item['quantity'];
                            $total += $itemPrice * $itemQuantity;
                        ?>
                            <figure style="margin-bottom: 20px;">
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                     style="max-width: 150px; max-height: 150px;">
                                <figcaption>
                                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p>Price: $<?php echo number_format($itemPrice, 2); ?></p>
                                    <p>Quantity: <?php echo htmlspecialchars($itemQuantity); ?></p>
                                    <label for="quantity-<?php echo htmlspecialchars($item['id']); ?>">Adjust Quantity:</label>
                                    <input type="number" name="quantity[<?php echo htmlspecialchars($item['id']); ?>]" 
                                           id="quantity-<?php echo htmlspecialchars($item['id']); ?>" 
                                           value="<?php echo htmlspecialchars($itemQuantity); ?>" min="1" style="width: 50px;">
                                    <input type="hidden" name="itemID[]" value="<?php echo htmlspecialchars($item['id']); ?>">
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                        <p><strong>Total: $<span id="total-price"><?php echo number_format($total, 2); ?></span></strong></p>

                        <?php 
                      if(isset($_SESSION['user'])){
                        echo '<button class="filter-btn" type="submit"  name="submitBtn">Submit</button>
                        <button class="filter-btn" type="submit" name="DeleteCart">Clear Cart</button>';
                      }
                        
                        ?>

                    </div>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </form>
        </main>
    </div>
    <div id="content">
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
