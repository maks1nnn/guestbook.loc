<?php
session_start();

require  '../helpers/Autoloader.php';

require  '../config/dbusers.php';

require  '../helpers/printDebugs.php';

use vendor\Db;
use vendor\SelectQueryBuilder;
use vendor\Validator;

$tableName = $db_config['db']['tablename'];




$username = $_POST['userName'];
$usernameT = "'" . $username . "'";
$password = $_POST['password'];
$infoUsers = '\..\config\dbusers.php';


$db = Db::getInstance(); // db connect

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
    header("Location: indexEnter.php");

    exit;
}
// Проверка пароля
if (!password_verify($password, $result['pass'])) {
    $_SESSION['message'] = "Неправильный пароль.";
    header("Location: indexEnter.php");

    exit;
}


$_SESSION['login'] = $username;

header("Location: indexComments.php");

