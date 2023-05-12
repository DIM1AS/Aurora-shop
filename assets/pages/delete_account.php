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
