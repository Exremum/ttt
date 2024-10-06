<?php
// config.php
$host = 'localhost'; // Адрес сервера БД
$db = 'conference_db'; // Имя вашей базы данных
$user = 'rooy'; // Имя пользователя БД
$pass = ''; // Пароль пользователя БД

try {
    // Создание подключения к базе данных
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Установка режима ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
