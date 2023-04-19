<?php

session_start();
if (!empty($_SESSION['login'])) {
    $name = $_SESSION['login'];
    unset($_SESSION['login']);
} else {
    $name = "";
}

if (!empty($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}

require  '../helpers/Autoloader.php';

include   '../view/zeroPage.php';
