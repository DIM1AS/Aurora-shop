<?php
// Подключаемся к базе данных
include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Получаем id товара из GET-запроса
$product_id = $_GET["id"];

// Получаем id пользователя из сессии
session_start();
$user_id = $_SESSION['user_id'];

// Проверяем, есть ли уже такой товар в корзине пользователя
$cart_result = $mysqli->query("SELECT * FROM cart WHERE product_id = " . $product_id . " AND user_id = " . $user_id);
if ($cart_result->num_rows > 0) {
    // Если есть, увеличиваем количество на 1
    $cart_row = $cart_result->fetch_assoc();
    $cart_id = $cart_row["id"];
    $cart_quantity = $cart_row["quantity"] + 1;
    $mysqli->query("UPDATE cart SET quantity = " . $cart_quantity . " WHERE id = " . $cart_id);
} else {
    // Если нет, добавляем товар в корзину пользователя
    $mysqli->query("INSERT INTO cart (product_id, user_id) VALUES (" . $product_id . ", " . $user_id . ")");
}

// Перенаправляем пользователя на страницу корзины

header("Location: ../../assets/pages/profile.php");

// Закрываем соединение с базой данных
$mysqli->close();
