<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Добавление товара в корзину
if (isset($_POST['buy'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['buy'];
    $result = $mysqli->query("SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");
    if ($result->num_rows > 0) {
        $mysqli->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        $mysqli->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");
    }
}

// Вывод корзины
$user_id = $_SESSION['user_id'];
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
        <?php
    // Вывод корзины
    $result = $mysqli->query("SELECT products.*, cart.quantity FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.user_id = $user_id");

    if ($result->num_rows > 0) {
        echo "<form method='post' action='buy_all.php'>";
        echo "<table>";
        echo "<tr><th>Название товара</th><th>Количество</th><th>Цена</th><th></th></tr>";
        $total_price = 0;
        while ($row = $result->fetch_assoc()) {
            $quantity = $row["quantity"];
            $price = $row["price"];
            $total = $quantity * $price;
            $total_price += $total;
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $quantity . "</td>";
            echo "<td>" . $price . "</td>";
            echo "<td><button type='submit' name='buy' value='" . $row["id"] . "' class='add-to-cart-btn'>Купить</button></td>";
            echo "</tr>";
        }
        echo "<tr><td colspan=\"3\">Итого:</td><td>" . $total_price .  " ₽ </td></tr>";
        echo "</table>";
        echo "</form>";
        echo "<p><a href=\"clear_cart.php\" class=\"clear-cart-link\">Очистить корзину</a></p>";
    } else {
        echo "<p>Корзина пуста.</p>";
    }

    $mysqli->close();
    ?>


</div>
</body>
</html>