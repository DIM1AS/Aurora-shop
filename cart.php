<?php
// Проверяем, авторизован ли пользователь
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Корзина товаров | HYDRA 3.0 </title>
    <link rel="stylesheet" href="../../assets/css/cart.css">
</head>
<body>
    <div class="container">
    <div class="header">            
  <h1>Корзина товаров</h1>
  <div>
    <a href="profile.php" class="cart-btn" style="text-decoration:none;">Назад</a>                                
  </div>
</div>

        <?php

          

            // Подключаемся к базе данных
            $mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");

            // Выбираем все товары из корзины
            $result = $mysqli->query("SELECT products.*, cart.quantity FROM products INNER JOIN cart ON products.id = cart.product_id");

            // Если есть результаты, выводим их
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

            // Закрываем соединение с базой данных
            $mysqli->close();
        ?>
    </div>
</body>
</html>
