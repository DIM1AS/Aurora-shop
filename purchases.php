<?php
// Подключаемся к базе данных
$mysqli = new mysqli("localhost", "root", "", "Aurora_Shop");

// Выбираем все покупки
$result = $mysqli->query("SELECT * FROM purchases ORDER BY id DESC");

// Если есть результаты, выводим их
if ($result->num_rows > 0) {
    echo "<h1>Список покупок</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Дата</th><th>Сумма</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "<td>" . $row["total_price"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Покупок нет.</p>";
}

// Закрываем соединение с базой данных
$mysqli->close();
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