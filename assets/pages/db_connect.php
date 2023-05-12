<?php
// Параметры подключения к базе данных
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'GameEvo';

// Подключение к базе данных
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Проверка подключения к базе данных
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
?>
