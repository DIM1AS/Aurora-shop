<?php

// Подключаемся к базе данных
include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Очищаем таблицу корзины
$mysqli->query("TRUNCATE TABLE cart");

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
    <title>GAMESTATION</title>
</head>

<body>

</body>

</html>