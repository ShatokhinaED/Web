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

// Обработка отправленной формы регистрации
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем новый логин и пароль из формы
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Проверяем, существует ли аккаунт с таким логином
    $check_existing = "SELECT * FROM login_table WHERE username = '$new_username'";
    $result = $conn->query($check_existing);

    if ($result->num_rows > 0) {
        echo "Аккаунт с таким логином уже существует.";
    } else {
        // Аккаунта с таким логином нет, создаем новый
        $plain_password = $new_password;
        $inverted_binary_password = strrev(decbin(ord($new_password))); // Инвертированный двоичный код символов пароля

        $sql_register = "INSERT INTO login_table (username, password_plain, password_inverted_binary) VALUES ('$new_username', '$plain_password', '$inverted_binary_password')";
        $conn->query($sql_register);
        echo "Аккаунт успешно зарегистрирован.";
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
