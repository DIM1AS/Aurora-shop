<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение id товара из POST-запроса
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Удаление товара из корзины
    $mysqli->query("DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");

    // Получение количества удаленных строк
    $affected_rows = $mysqli->affected_rows;

    if ($affected_rows > 0) {
        // Товар успешно удален
        // Можно выполнить дополнительные действия или вывести сообщение об успешном удалении
        echo "Товар успешно удален из корзины.";
    } else {
        // Произошла ошибка при удалении товара
        // Можно выполнить дополнительные действия или вывести сообщение об ошибке
        echo "Ошибка при удалении товара из корзины.";
    }
}

// Закрываем соединение с базой данных
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>