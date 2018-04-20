<?php
// On teste si la variable de session existe et contient une valeur
if (!empty($_SESSION['login'])) {
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
}
header('Location: index');
?>
