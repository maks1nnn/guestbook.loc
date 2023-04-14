<?php


require __DIR__ . '/Classes/Autoloader.php';

use classes\Db;
use classes\SelectQueryBuilder;
use classes\Validator;


// Проверка пароля
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $dbh->prepare('SELECT password FROM users WHERE username = :username');
$stmt->bindParam(':username', $username);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    echo "Пользователь не найден.";
    exit;
}

if (!password_verify($password, $row['password'])) {
    echo "Неправильный пароль.";
    exit;
}

echo "Вход выполнен успешно!";