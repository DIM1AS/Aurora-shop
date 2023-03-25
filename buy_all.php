<?php
// Подключаемся к базе данных
$mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");

// Выбираем все товары из корзины
$result = $mysqli->query("SELECT products.*, cart.quantity FROM products INNER JOIN cart ON products.id = cart.product_id");

// Если есть результаты, выводим их
if ($result->num_rows > 0) {
    // Создаем массив, в который будем добавлять ID товаров для удаления из корзины
    $product_ids = array();

    // Создаем переменную для подсчета общей суммы
    $total_price = 0;

    while ($row = $result->fetch_assoc()) {
        $quantity = $row["quantity"];
        $price = $row["price"];
        $total = $quantity * $price;
        $total_price += $total;

        // Добавляем ID товара в массив
        $product_ids[] = $row["product_id"];
    }

    // Формируем строку для запроса на удаление товаров из корзины
    $product_ids_str = implode(",", $product_ids);

    // Удаляем товары из корзины
    $mysqli->query("DELETE FROM cart WHERE product_id IN ($product_ids_str)");

    // Добавляем запись о покупке в таблицу покупок
    $mysqli->query("INSERT INTO purchases (total_price) VALUES ($total_price)");

    // Закрываем соединение с базой данных
    $mysqli->close();

    // Перенаправляем пользователя на страницу с покупками
    header("Location: purchases.php");
    exit();
} else {
    // Закрываем соединение с базой данных
    $mysqli->close();

    // Перенаправляем пользователя на страницу корзины
    header("Location: cart.php");
    exit();
}
