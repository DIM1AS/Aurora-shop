<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная | Aurora Shop </title>
    <link rel="stylesheet" href="../../assets/css/profile.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Главная | Aurora Shop</h1>
            <a class="cart-btn" href="cart.php">Корзина</a>
            <a class="logout-btn" href="index.php">Выйти</a>            
        </div>
        <div class="product-list">
            <?php
            // Подключаемся к базе данных
            $mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");
                    // Выбираем все товары из таблицы products
        $result = $mysqli->query("SELECT * FROM products");

        // Если есть результаты, выводим их
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Название</th><th>Цена</th><th>Добавить в корзину</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td><a class=\"add-to-cart-btn\" href=\"add_to_cart.php?id=" . $row["id"] . "\">Добавить в корзину</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "Товаров не найдено.";
        }

        // Закрываем соединение с базой данных
        $mysqli->close();
        ?>
    </div>
</div>
</body>
</html>
