<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

$user_id = $_SESSION['user_id'];

// Получение списка товаров в корзине пользователя
$result = $mysqli->query("SELECT products.*, cart.quantity FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.user_id = $user_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Корзина товаров | GameEvo </title>
    <link rel="stylesheet" href="../../assets/css/cart.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Корзина товаров</h1>
            <div>
                <a href="../../assets/pages/profile.php" class="cart-btn" style="text-decoration:none;">Назад</a>
            </div>
        </div>
        <?php if ($result->num_rows > 0): ?>
            <form method="post" action="delete_product.php">
                <table>
                    <tr>
                        <th>Название товара</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>
                    <?php
                    $total_price = 0;
                    while ($row = $result->fetch_assoc()) {
                        $product_id = $row["product_id"];
                        $quantity = $row["quantity"];
                        $price = $row["price"];
                        $total = $quantity * $price;
                        $total_price += $total;
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $quantity . "</td>";
                        echo "<td>" . $price . "</td>";
                        echo "<td><button type='submit' name='delete' value='" . $product_id . "' class='delete-product-btn'>Удалить товар</button></td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="3">Итого:</td>
                        <td><?php echo $total_price; ?> ₽</td>
                    </tr>
                </table>
            </form>
            <p><a href="clear_cart.php" class="clear-cart-link">Очистить корзину</a></p>
        <?php else: ?>
            <p>Корзина пуста.</p>
        <?php endif; ?>

    </div>
</body>
</html>
