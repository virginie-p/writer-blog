<?php

require(__DIR__.'/controller/frontend.php');
require(__DIR__.'/controller/backend.php');

try {
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password_hash'])){
    }
    else {
        showDisconnectedMenu();
    }
}
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}