<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'conference_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение данных формы
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$section = $_POST['section'];
$birth_date = $_POST['birth_date'];
$report = isset($_POST['report']) ? 1 : 0;
$report_topic = $_POST['report_topic'] ?? null;

// Валидация данных
if (!preg_match("/^[А-Яа-яЁё\s]+$/u", $full_name)) {
    die("Имя должно содержать только буквы русского алфавита.");
}

if (!preg_match("/^\+7\d{10}$/", $phone)) {
    die("Телефон должен содержать 11 цифр и начинаться с +7.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Некорректный email.");
}

// Вставка данных в базу данных
$sql = "INSERT INTO participants (full_name, phone, email, section, birth_date, report, report_topic) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$full_name, $phone, $email, $section, $birth_date, $report, $report_topic]);

// Отображение введенных данных
echo "<h1>Вы успешно зарегистрировались</h1>";
echo "<p>ФИО: $full_name</p>";
echo "<p>Телефон: $phone</p>";
echo "<p>Email: $email</p>";
echo "<p>Секция: $section</p>";
echo "<p>Дата рождения: $birth_date</p>";
echo "<p>Доклад: " . ($report ? "Да, тема: $report_topic" : "Нет") . "</p>";
?>