<?php
// Подключение к базе данных
include('../../assets/pages/db_connect.php');

// Проверка подключения к базе данных
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

error_reporting(0);
ini_set('display_errors', 0);


// Обработка данных формы авторизации при отправке
if (isset($_POST['submit'])) {
    // Получение данных из формы авторизации
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Поиск пользователя с таким же email в базе данных
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Проверка, соответствует ли введенный пароль хешу пароля в базе данных
    if (password_verify($password, $user['password'])) {
        // Если пароли совпадают, запись id пользователя в сессию и перенаправление на страницу профиля
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('location: ../../assets/pages/profile.php'); //это 
    } else {
        // Если пароли не совпадают, вывод сообщения об ошибке
        $errorMessage = "Неверный email или пароль";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Авторизация | GameEvo </title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>

    <form method="post" action="">
        <h1>Авторизация</h1>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Войти">
        <p>Еще не зарегистрированы? <a href="../../assets/pages/register.php">Зарегистрируйтесь</a></p>
        <p class="error-message">
            <?php echo isset($errorMessage) ? $errorMessage : ''; ?>
        </p>
    </form>

</body>

</html>