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

require __DIR__ . '/Classes/Autoloader.php';

include __DIR__ . '/public/Front.php';

require __DIR__ . '/config/dbinfo.php';

require __DIR__ . '/config/helper.php';


use classes\InsertQueryBuilder;
use classes\Db;
use classes\SelectQueryBuilder;
use classes\Validator;
use classes\Pagination;
use classes\Paginator;




/*$validator = new Validator($_POST);
$errors = $validator->validateForm();


if(!empty($errors)){die(PR ($errors));}*/

$infoComment = '\..\config\dbinfo.php';

$tableName = $db_config['db']['tablename'];

$db = Db::getInstance($infoComment); // db connect
//PR($_POST);
//PR($tableName);
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
//PR($db->query($query->build())->fetchAll());
$total = count($result);
unset($query);

echo $total;


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



/*foreach ($result as $name){
    echo "{$name['name']}{$name['comment']}{$name['email']}<br>";
}*/



/*$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$uri = $url[0];
PR ($url);*/




 //PR($db->query($query->build())->fetchAll());



/*$page= $_GET['page'] ?? 1;
$perpage = 10;
$total = count($result);
$pagination = new Pagination($page, $perpage, $total);
$start = $pagination->get_start();
$query = new SelectQueryBuilder();
$query->select(['comment', 'name','email'])
    ->from($tableName)
    
    ->orderBy('id')
    ->limit($perpage)
    ;

 $result = $db->query($query->build())->fetchAll();
 //PR($db->query($query->build())->fetchAll());

unset($query);



foreach ($result as $name){
    echo "{$name['name']}{$name['comment']}{$name['email']}<br>";
}
echo $pagination->getHtml();*/
