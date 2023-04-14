<?php
session_start();

require __DIR__ . '/Classes/Autoloader.php';

require __DIR__ . '/config/dbusers.php';

require __DIR__ . '/config/helper.php';

use classes\Db;
use classes\SelectQueryBuilder;
use classes\Validator;

$tableName = $db_config['db']['tablename'];




$username = $_POST['userName'];
$usernameT = "'" . $username . "'";
$password = $_POST['password'];
$infoUsers = '\..\config\dbusers.php';


$db = Db::getInstance($infoUsers); // db connect

$query = new SelectQueryBuilder();
$query->select(['pass'])
    ->from($tableName)

    ->where('login ', ' = ', $usernameT);
$result = $db->query($query->build())->fetch();
//PR($result);
//print_r($result['pass']);
//die();
unset($query);


if (!empty($rezult)) {
    $_SESSION['message'] = "Пользователь не найден.";
    header("Location: indexenter.php");

    exit;
}
// Проверка пароля
if (!password_verify($password, $result['pass'])) {
    $_SESSION['message'] = "Неправильный пароль.";
    header("Location: indexenter.php");

    exit;
}


$_SESSION['login'] = $username;

header("Location: index.php");

