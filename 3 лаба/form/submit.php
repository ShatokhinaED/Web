<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clients";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];
    $gender = $_POST["gender"];
    $topics = implode(", ", $_POST["topic"]);

    // SQL-запрос для вставки данных в базу данных
    $sql = "INSERT INTO feedback (first_name, last_name, email, feedback, gender, topics)
            VALUES ('$firstName', '$lastName', '$email', '$feedback', '$gender', '$topics')";

    if ($conn->query($sql) === TRUE) {
        // Перенаправление на страницу благодарности после успешной отправки
        header("Location: thankyou.html");
        exit();
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
