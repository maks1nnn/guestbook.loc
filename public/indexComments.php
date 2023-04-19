<?php
session_start();
if (!empty($_SESSION['login'])) {
    $name = $_SESSION['login'];
    unset($_SESSION['login']);
} else {
    $name = "";
}
if (!empty($_SESSION['email'])) {
    $email = $_SESSION['email'];
    unset($_SESSION['email']);
} else {
    $email = "";
}

require  '../helpers/Autoloader.php';

include  '../view/Front.php';

require  '../config/dbinfo.php';

require  '../helpers/printDebugs.php';


use vendor\InsertQueryBuilder;
use vendor\Db;
use vendor\SelectQueryBuilder;
use vendor\Validator;




/*$validator = new Validator($_POST);
$errors = $validator->validateForm();


if(!empty($errors)){die(PR ($errors));}*/




$tableName = 'Gbase';

$db = Db::getInstance(); // db connect

if (!empty($_POST)) {
    $param = ['name' => $_POST['user'], 'email' => $_POST['email'], 'comment' => $_POST['comment']];




    $query = new InsertQueryBuilder();
    $query->into($tableName)
        ->values($param);

    $db->query($query->build());
    unset($query);
}

$query = new SelectQueryBuilder();
$query->select(['comment', 'name', 'email'])
    ->from($tableName)

    ->orderBy('id');

$result = $db->query($query->build())->fetchAll();
$total = count($result);
unset($query);




// задаю стартовый гет
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$recordsPerPage = 10;

$startPozishion = ($currentPage - 1) * $recordsPerPage;

$countPages = $total / $recordsPerPage;

$query = new SelectQueryBuilder();
$query->select(['comment', 'name', 'email'])
    ->from($tableName)

    ->orderBy('id')
    ->limit($recordsPerPage)
    ->offset($startPozishion);

$result = $db->query($query->build())->fetchAll();

foreach ($result as $name) {
    echo "{$name['name']}{$name['comment']}{$name['email']}<br>";
}

for ($i = 1; $i < $countPages; $i++) {
    echo "<a href='?page=$i'>" . $i . "</a><br>";
}
