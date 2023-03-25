<?php

session_start(); // начинаем сессию

// уничтожаем данные сессии
session_unset();
session_destroy();

// перенаправляем пользователя на страницу входа
header('Location: login.php');
exit;

?>