<?php
// Включаем вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение к базе данных (замените данными вашей БД)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clients";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Обработка отправленной формы авторизации
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем логин и пароль из формы
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ищем пользователя с указанным логином
    $sql = "SELECT * FROM login_table WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Пользователь найден, проверяем пароль
        $row = $result->fetch_assoc();
        $hashed_password_plain = $row['password_plain'];
        $hashed_password_inverted = $row['password_inverted'];

        if ($password == $hashed_password_plain || $password == $hashed_password_inverted) {
            echo "Авторизация успешна.";
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь с таким логином не найден.";
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
