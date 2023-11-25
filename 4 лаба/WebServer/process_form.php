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

// Получение данных из формы
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$product = $_POST['product'];
$comments = $_POST['comments'];

// Подготовка SQL-запроса для вставки данных в таблицу
$sql = "INSERT INTO orders (lastName, firstName, middleName, address, phone, email, product, comments) VALUES ('$lastName', '$firstName', '$middleName', '$address', '$phone', '$email', '$product', '$comments')";

// Выполнение SQL-запроса
if ($conn->query($sql) === TRUE) {
    echo "Заказ успешно добавлен.";
} else {
    echo "Ошибка при добавлении заказа: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
