<?php
// Подключаемся к базе данных
$mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");

// Получаем id товара из GET-запроса
$product_id = $_GET["id"];

// Проверяем, есть ли уже такой товар в корзине
$cart_result = $mysqli->query("SELECT * FROM cart WHERE product_id = " . $product_id);
if ($cart_result->num_rows > 0) {
    // Если есть, увеличиваем количество на 1
    $cart_row = $cart_result->fetch_assoc();
    $cart_id = $cart_row["id"];
    $cart_quantity = $cart_row["quantity"] + 1;
    $mysqli->query("UPDATE cart SET quantity = " . $cart_quantity . " WHERE id = " . $cart_id);
} else {
    // Если нет, добавляем товар в корзину
    $mysqli->query("INSERT INTO cart (product_id) VALUES (" . $product_id . ")");
}

// Перенаправляем пользователя на страницу корзины
header("Location: cart.php");

// Закрываем соединение с базой данных
$mysqli->close();

?>
