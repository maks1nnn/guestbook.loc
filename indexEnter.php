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
require __DIR__ . '/Classes/Autoloader.php';

include __DIR__ . '/public/zeropage.php';
