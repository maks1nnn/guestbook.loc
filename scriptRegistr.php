<?php
session_start();


require __DIR__ . '/Classes/Autoloader.php';

require __DIR__ . '/config/dbusers.php';

require __DIR__ . '/config/helper.php';


use classes\InsertQueryBuilder;
use classes\Db;
use classes\SelectQueryBuilder;
use classes\Validator;



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
    header("Location: indexregistr.php");
    exit;
}
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$db = Db::getInstance($infoUsers); // db connect

$query = new SelectQueryBuilder();
$query->select(['login'])
    ->from($tableName)

    ->where('login ', ' = ', $usernameT);
$result = $db->query($query->build())->fetchAll();

unset($query);

if (!empty($result)) {
    $_SESSION['message'] = "Такое имя пользователя уже есть";
    header("Location: indexregistr.php");
    exit;
} else {
    $param = ['login' => $_POST['userName'],'email' => $_POST['email'], 'pass' =>  $hashed_password];
    PR($param);
    $query = new InsertQueryBuilder();
    $query->into($tableName)
        ->values($param);

    $db->query($query->build());
    unset($query);
}
$_SESSION['email'] = $email;
$_SESSION['login'] = $username;
header("Location: indexenter.php");
