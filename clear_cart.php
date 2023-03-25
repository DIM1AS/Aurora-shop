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