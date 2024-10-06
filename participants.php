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

// Получение списка участников
$sql = "SELECT * FROM participants";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$participants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Отображение таблицы участников
echo "<h1>Список участников</h1>";
echo "<table border='1'>
        <tr>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Секция</th>
            <th>Дата рождения</th>
            <th>Доклад</th>
        </tr>";

foreach ($participants as $participant) {
    echo "<tr>
            <td>{$participant['full_name']}</td>
            <td>{$participant['phone']}</td>
            <td>{$participant['email']}</td>
            <td>{$participant['section']}</td>
            <td>{$participant['birth_date']}</td>
            <td>" . ($participant['report'] ? "Да, тема: {$participant['report_topic']}" : "Нет") . "</td>
          </tr>";
}

echo "</table>";
?>
