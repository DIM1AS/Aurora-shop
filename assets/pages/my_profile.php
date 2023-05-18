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

// Получаем данные пользователя (имя и почта)
$user_result = $mysqli->query("SELECT name, email FROM users WHERE id = " . $user_id);
$user_row = $user_result->fetch_assoc();
$user_name = $user_row["name"];
$user_email = $user_row["email"];

// Обработка отправленной формы с удалением учетной записи
if (isset($_POST['delete_account'])) {
    // Показываем подтверждающее сообщение и форму для удаления
    $confirm_message = "Вы уверены, что хотите удалить учетную запись? Все данные будут безвозвратно удалены.";
    $show_confirm_form = true;
} elseif (isset($_POST['confirm_delete'])) {
    // Пользователь подтвердил удаление, удаляем учетную запись
    $mysqli->query("DELETE FROM users WHERE id = $user_id");

    // Очищаем сессию и перенаправляем пользователя на страницу входа
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} elseif (isset($_POST['cancel_delete'])) {
    // Пользователь отменил удаление, перенаправляем на страницу профиля
    header("Location: profile.php");
    exit();
}

// Закрываем соединение с базой данных
$mysqli->close();   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой профиль | GameEvo</title>
    <link rel="stylesheet" href="../../assets/css/my_profile.css">
    <script src="../../assets/js/my_profile.js"></script>
</head>
<body>
<h1>Мой профиль</h1>
<p>Имя: <?php echo $user_name; ?></p>
<p>Почта: <?php echo $user_email; ?></p>
<form method="POST" action="../../assets/pages/profile.php">
    <button type="submit" name="up">Назад</button>
</form> 

<form method="POST" action="../../assets/pages/change_password.php">
    <button type="submit" name="reset">Изменить пароль</button>
</form>

<form method="POST" action="">
    <button type="submit" name="delete_account">Удалить учетную запись</button>
</form>

<?php if (isset($confirm_message) && $show_confirm_form): ?>
    <form method="POST" action="">
        <p><?php echo $confirm_message; ?></p>
        <button type="submit" name="confirm_delete">Да, удалить</button>
        <button type="submit" name="cancel_delete">Отмена</button>
    </form>
<?php endif; ?>

</body>
</html>
