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
header("Location: ../../assets/pages/cart.php");

// Закрываем соединение с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Удаление продуктов | GameEvo </title>
</head>
<body>
    
</body>
</html>
