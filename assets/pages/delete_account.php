<?php
// Подключаемся к базе данных
include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Получаем id пользователя из сессии
session_start();
$user_id = $_SESSION['user_id'];

// Удаляем учетную запись пользователя
$mysqli->query("DELETE FROM users WHERE id = $user_id");

// Закрываем сессию и перенаправляем пользователя на страницу входа
session_destroy();
header("Location: ../../index.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Удаление пользователей | GameEvo </title>
</head>
<body>
    
</body>
</html>