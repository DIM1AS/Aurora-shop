<?php
// Подключение к базе данных
$conn = mysqli_connect('localhost', 'root', '', 'Aurora_Shop');

// Проверка подключения к базе данных
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

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
        header('location: profile.php');
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
    <title> Авторизация | HYDRA 3.0 </title>
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>

<body>


    <form method="post" action="">
        <h1>Авторизация</h1>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Войти">
        <p>Еще не зарегистрированы? <a href="register.php">Зарегистрируйтесь</a></p>
        <p class="error-message">
            <?php echo isset($errorMessage) ? $errorMessage : ''; ?>
        </p>
    </form>


</body>

</html>