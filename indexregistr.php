<?php
session_start();

if (!empty($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
}

unset($_SESSION['message']);

require __DIR__ . '/Classes/Autoloader.php';

include __DIR__ . '/public/registrpage.php';

