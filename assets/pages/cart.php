<?php
// Проверяем, авторизован ли пользователь
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../assets/pages/login.php');
    exit();
}

// Проверяем, была ли нажата кнопка "Купить"
if (isset($_POST['buy'])) {
    // Проводим фейковую оплату
    sleep(2); // имитация задержки обработки оплаты
    // Выводим сообщение о покупке
    echo "<script>alert('Оплата прошла успешно!');</script>";
    // Очищаем корзину текущего пользователя
    include('../../assets/pages/db_connect.php');
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $user_id = $_SESSION['user_id'];
    $mysqli->query("DELETE FROM cart WHERE user_id = $user_id");
    $mysqli->close();
}

// Проверяем, была ли нажата кнопка "Очистить корзину"
if (isset($_POST['clear'])) {
    // Очищаем корзину текущего пользователя
    include('../../assets/pages/db_connect.php');
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $user_id = $_SESSION['user_id'];
    $mysqli->query("DELETE FROM cart WHERE user_id = $user_id");
    $mysqli->close();
    header("Location: ../../assets/pages/cart.php"); // Перенаправляем пользователя на страницу корзины после очистки
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Корзина товаров | GameEvo </title>
    <link rel="stylesheet" href="../../assets/css/cart.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Корзина товаров</h1>
            <div>
                <a href="../../assets/pages/profile.php" class="cart-btn_1" style="text-decoration:none;">Назад</a>
            </div>
        </div>

        <?php

        // Подключаемся к базе данных
        include('../../assets/pages/db_connect.php');
        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Получаем id пользователя из сессии
        $user_id = $_SESSION['user_id'];

        // Выбираем все товары из корзины для текущего пользователя
        $result = $mysqli->query("SELECT products.*, cart.quantity FROM products INNER JOIN cart ON products.id = cart.product_id WHERE cart.user_id = $user_id");

        // Если есть товары в корзине, выводим их
        if ($result->num_rows > 0) {
            echo "<form method='post' action='../../assets/pages/buy_all.php'>";
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
                echo "<td><a href='../../assets/pages/remove_product.php?id=" . $row["id"] . "' class='delete-product-btn'>Удалить товар</a></td>";
                echo "</tr>";
            }
            echo "<tr><td colspan=\"3\">Итого:</td><td>" . $total_price .  " ₽ </td></tr>";
            echo "</table>";
            echo "</form>";
            echo "<form method='post' action='../../assets/pages/cart.php'>";
            echo "<button type='submit' name='clear' class='clear-cart-btn'>Очистить корзину</button>";
            echo "<button type='submit' name='buy' class='buy-product-btn'>Купить</button>";
            echo "</form>";
        } else {
            echo "<p>Корзина пуста.</p>";
        }
        // Закрываем соединение с базой данных
        $mysqli->close();
        ?>
    </div>
</body>

</html>
