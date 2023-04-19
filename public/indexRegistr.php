<?php


session_start();

if (!empty($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}

unset($_SESSION['message']);


require  '../helpers/Autoloader.php';

include    '../view/registrPage.php';
