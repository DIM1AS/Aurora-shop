<?php
session_start();
// Подключение к базе данных
include('../../assets/pages/db_connect.php');

// Проверка подключения к базе данных
if (!$conn) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}

// Обработка данных формы регистрации при отправке
if (isset($_POST['submit'])) {
    // Получение данных из формы регистрации
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Проверка, есть ли уже пользователь с таким же email
    $sql_check = "SELECT * FROM users WHERE email='$email'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        $_SESSION['message'] = "Пользователь с таким email уже зарегистрирован";
    } else {
        // Добавление нового пользователя в базу данных
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            // Если новый пользователь успешно добавлен, перенаправление на страницу авторизации
            header('location: ../../assets/pages/login.php');
        } else {
            // Если произошла ошибка при добавлении пользователя, вывод сообщения об ошибке
            $_SESSION['message'] = "Ошибка регистрации: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Регистрация | GameEvo </title>
    <link rel="stylesheet" href="../../assets/css/register.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>

    <?php if (isset($_SESSION['message'])) : ?>
        <div class="error-message">
            <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif ?>
    <div class="form-container">
        <h1>Регистрация</h1>
        <form method="post" action="">
            <label>Имя:</label>
            <input type="text" name="name" required><br><br>
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
            <label>Пароль:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="submit" value="Зарегистрироваться">
        </form>
    </div>

</body>

</html>

<?php if (isset($_SESSION['message'])) : ?>
    <div class="error-message">
        <?= $_SESSION['message'] ?>
    </div>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>