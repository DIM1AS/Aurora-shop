<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Подключаемся к базе данных
include('../../assets/pages/db_connect.php');
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Получаем id пользователя из сессии
$user_id = $_SESSION['user_id'];

// Обработка отправленной формы с изменением пароля
if (isset($_POST['change_password'])) {
    // Получаем текущий и новый пароль из формы
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Проверяем, совпадает ли текущий пароль с паролем пользователя в базе данных
    $password_result = $mysqli->query("SELECT password FROM users WHERE id = " . $user_id);
    $password_row = $password_result->fetch_assoc();
    $stored_password = $password_row['password'];

    if (password_verify($current_password, $stored_password)) {
        // Текущий пароль верный, обновляем пароль пользователя в базе данных
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $mysqli->query("UPDATE users SET password = '$hashed_password' WHERE id = $user_id");

        // Перенаправляем пользователя на страницу профиля с сообщением об успешном изменении пароля
        $_SESSION['password_changed'] = true;
        header("Location: profile.php");
        exit();
    } else {
        // Текущий пароль неверный, выводим сообщение об ошибке
        $error_message = "Текущий пароль неверный. Попробуйте еще раз.";
    }
}

// Закрываем соединение с базой данных
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Изменение пароля | GameEvo</title>
    <link rel="stylesheet" href="../../assets/css/my_profile.css">
</head>
<body>
<h1>Изменение пароля</h1>
<form method="POST" action="">
    <label for="current_password">Текущий пароль:</label>
    <input type="password" id="current_password" name="current_password" required><br>
    <label for="new_password">Новый пароль:</label>
    <input type="password" id="new_password" name="new_password" required><br>
    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <button type="submit" name="change_password">Изменить пароль</button>
</form>
<form method="POST" action="../../assets/pages/my_profile.php">
    <button type="submit" name="reset">Назад</button>
</form>
</body>
</html>


