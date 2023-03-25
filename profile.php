<?php
// Проверяем, авторизован ли пользователь
session_start();

if (!isset($_SESSION['user_id'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу авторизации
    header('Location: login.php');
    exit;
}

// Если пользователь авторизован, приветствуем его по имени
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Гость'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная | Aurora Shop </title>
    <link rel="stylesheet" href="../../assets/css/profile.css">
</head>

<body>
    <h1>Защищенная страница</h1>
    <p>Привет,
        <?php echo $name; ?>! Вы успешно авторизовались и получили доступ к этой странице.
    </p>
    <p><a href="logout.php">Выйти</a></p>
</body>

</html>