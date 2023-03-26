<?php
// Подключаемся к базе данных
$mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");

// Очищаем таблицу корзины
$mysqli->query("TRUNCATE TABLE cart");

// Перенаправляем пользователя на страницу корзины
header("Location: cart.php");

// Закрываем соединение с базой данных
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYDRA 3.0</title>
</head>
<body>
    
</body>
</html>