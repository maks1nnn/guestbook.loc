<?php
session_start();


require  '../helpers/Autoloader.php';

require  '../config/dbusers.php';

require  '../helpers/printDebugs.php';


use vendor\InsertQueryBuilder;
use vendor\Db;
use vendor\SelectQueryBuilder;
use vendor\Validator;
use models\insertUserNameInDb;



$infoUsers = '\..\config\dbusers.php';

$tableName = $db_config['db']['tablename'];

$username = $_POST['userName'];
$usernameT = "'" . $username . "'";
$email = $_POST['email'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatpassword'];



    // Проверяем, совпадают ли пароли
if ($password != $repeatPassword) {
    // Пароли не совпадают, возвращаем пользователя на страницу формы
    $_SESSION['message'] = 'пароли не совпадают';
    header("Location: indexRegistr.php");
    exit;
} 

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$db = Db::getInstance(); // db connect

$query = new SelectQueryBuilder();
$query->select(['login'])
    ->from($tableName)

    ->where('login ', ' = ', $usernameT);
$result = $db->query($query->build())->fetchAll();

unset($query);

if (!empty($result)) {
    $_SESSION['message'] = "Такое имя пользователя уже есть";
    header("Location: indexRegistr.php");
    exit;
} else {

    //PR($param);
    $query = new insertUserNameInDb($hashedPassword);
    $query->insert($db);
}
$_SESSION['email'] = $email;
$_SESSION['login'] = $username;
header("Location: index.php");
