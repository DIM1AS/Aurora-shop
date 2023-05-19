<?php
// Подключаемся к базе данных
include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Получаем id товара для удаления из GET-запроса
$product_id = $_GET["id"];

// Получаем id пользователя из сессии
session_start();
$user_id = $_SESSION['user_id'];

// Удаляем товар из корзины пользователя
$mysqli->query("DELETE FROM cart WHERE product_id = $product_id AND user_id = $user_id");

// Перенаправляем пользователя на страницу корзины
header("Location: cart.php");

// Закрываем соединение с базой данных
$mysqli->close();
?>
