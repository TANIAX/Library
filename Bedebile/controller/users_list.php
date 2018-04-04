<?php
require 'models/user.php';
if(empty($_SESSION['login'])){
    header('Location: index');
    exit();
}
elseif (!empty($_SESSION['login']) && $_SESSION['role'] == 1) {
  $users = getUsers();
  include 'views/users_list.php';
}
?>
