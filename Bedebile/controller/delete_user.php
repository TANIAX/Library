<?php
  //Charge le model user
  require 'models/user.php';
  //Est ce que l'id de l'user à été bien transmis ? et est ce que l'utilisateur connecter est admin ?
  if(!empty($_GET['id'] && $_SESSION['role'] == 1))
  {
      // Exectue la fonction visant a supprimer le compte grâce à l'id récuperer + sécurisation grâce à htmlspecialchars
      $user = deleteUser(htmlspecialchars($_GET['id']));
      // Une fois que c'est fais retourne à la page d'acceuil
      header('Location: welcome');// TODO: Afficher un message bien supprimer et/ou une alerte avant de supprimer
      exit();
  //Si pas D'utilisateur connecté ou pas d'id transmis, reviens à la page d'acceuil
  }else {
    header('Location: welcome');
  }
?>
