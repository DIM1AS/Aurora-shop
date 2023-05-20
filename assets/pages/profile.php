<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../assets/pages/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Каталог | GameEvo </title>
    <link rel="stylesheet" href="../../assets/css/profile.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Каталог | GameEvo</h1>
            <a class="cart-btn" href="../../assets/pages/cart.php">Корзина</a>
            <a class="profile-btn" href="../../assets/pages/my_profile.php">Мой профиль</a>
            <a class="logout-btn" href="../../assets/pages/logout.php">Выйти</a>
        </div>

        <div class="product-list">
            <?php
            // Подключаемся к базе данных
            include('../../assets/pages/db_connect.php');
            $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
            // Выбираем все товары из таблицы          
            $result = $mysqli->query("SELECT * FROM products");

            // Если есть результаты, выводим их
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product"></div>';
                    echo '<div class="product-item">';
                    echo '<img src="' . $row["image_url"] . '" alt="' . $row["name"] . '">';
                    echo '<div class="product-info">';
                    echo '<div class="product-name">' . $row["name"] . '</div>';
                    echo '<div class="product-description">' . $row["description"] . '</div>';
                    echo '<div class="product-price">' . $row["price"] . ' ₽</div>';
                    echo '<a class="buy-btn" href="../../assets/pages/add_to_cart.php?id=' . $row["id"] . '">Добавить в корзину</a>';
                    echo '</div>';
                    echo '</div>';
                }
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