<?php
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
$password = $_POST['password'];
$repeatPassword = $_POST['repeatpassword'];



// Проверяем, совпадают ли пароли
if ($password != $repeatPassword) {
    // Пароли не совпадают, возвращаем пользователя на страницу формы
    header("Location: indexregistr.php");
    exit();
}

$db = Db::getInstance($infoComment); // db connect

$query = new SelectQueryBuilder();
$query->select(['login'])
    ->from($tableName)

    ->where('login', '=' , $username)
    ;

$result = $db->query($query->build())->fetchAll();
PR($result);
unset($query);



$hashed_password = password_hash($password, PASSWORD_DEFAULT);

