<?php

session_start(); // начинаем сессию

// уничтожаем данные сессии
session_unset();
session_destroy();

// перенаправляем пользователя на страницу входа
header('Location: login.php');
exit;

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