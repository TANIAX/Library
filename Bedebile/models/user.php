<?php
require "db.php";

//Cette fonction va chercher toutes les information à propos d'un utilisateur en particulier.
function getUser($login) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT * FROM users WHERE user_login = :login');
    $reponse->execute(array('login' => $login));
    $donnees = $reponse->fetch();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}

function getUserByMail($email) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT user_email FROM users WHERE user_email = :email');
    $reponse->execute(array('email' => $email));
    $donnees = $reponse->fetch();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}

function getUsers() {
    $bdd = getDb();
    $reponse = $bdd->query('SELECT * FROM users');
    $donnees = $reponse->fetchAll();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}
//Cette fonction va chercher le mot de passe d'un utilisateur en particulier .
function getPassword($login) {
    $bdd = getDb();
    //$reponse = $db->query('SELECT * FROM USER WHERE login = \''.$login.'\'');
    $reponse = $bdd->prepare('SELECT user_password FROM users WHERE user_login = :login');
    $reponse->execute(array('login' => $login));
    $donnees = $reponse->fetch();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}

//Cette fonction ajoute un nouvelle utilisateur
function newUser($login,$password,$mail){
  $bdd = getDb();

  $query = "INSERT INTO users (user_login , user_password , user_email, user_role) VALUES('$login' , '$password' , '$mail', '2')";
  $transaction = $bdd->prepare($query); // Faire cela s'appele une transaction.
  $transaction->execute();
  return $transaction;
  }


function ExistLoginOrEmail($login, $email){
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT user_login FROM users WHERE user_login = :login');
    $reponse->execute(array('login' => $login));
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
    if (!$donnees) {
      $reponse = $bdd->prepare('SELECT user_email FROM users WHERE user_email = :email');
      $reponse->execute(array('email' => $email));
      $donnees2 = $reponse->fetch();
      $reponse->closeCursor();
      if (!$donnees2) {return false;}
      else {return true;}
    }
    else {return true;}
}

function deleteUser($id) {
    $bdd = getDb();
    $reponse = $bdd->prepare('DELETE FROM users WHERE user_id = :id;');
    $reponse->execute(array('id' => $id));
    $reponse->closeCursor(); // Termine le traitement de la requête
}

function getUserById($id) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT * FROM users WHERE user_id = :id');
    $reponse->execute(array('id' => $id));
    $donnees = $reponse->fetch();
    $reponse->closeCursor(); // Termine le traitement de la requête
    return $donnees;
}

function updateUser($login, $password,$mail,$adresse,$id,$role){
  $bdd = getDb();
  if (!empty($adresse) && $login != 'nochange' && $mail != 'nochange') {
    $req = $bdd->prepare('UPDATE users SET user_login = :login, user_password = :password, user_email = :mail ,user_adresse = :adresse, user_role =:role WHERE user_id = :id ');
    $req->execute(array(
    	'login' => $login,
    	'password' => $password,
    	'mail' => $mail,
      'adresse' => $adresse,
      'id' => $id,
      'role' => $role
    	));
  }
  elseif (!empty($adresse) && $login == 'nochange' && $mail == 'nochange') {
    $req = $bdd->prepare('UPDATE users SET user_password = :password, user_adresse = :adresse, user_role =:role WHERE user_id = :id ');
    $req->execute(array(
    	'password' => $password,
      'adresse' => $adresse,
      'id' => $id,
      'role' => $role
    	));
  }

  elseif (empty($adresse) && $login == 'nochange' && $mail == 'nochange'){
      $req = $bdd->prepare('UPDATE users SET user_password = :password, user_adresse = :adresse, user_role =:role WHERE user_id = :id ');
      $req->execute(array(
      	'password' => $password,
        'adresse' => '',
        'id' => $id,
        'role' => $role
      	));
      }
      elseif (empty($adresse) && $login != 'nochange' && $mail != 'nochange') {
        $req = $bdd->prepare('UPDATE users SET user_login = :login, user_password = :password, user_email = :mail ,user_adresse = :adresse, user_role =:role WHERE user_id = :id ');
        $req->execute(array(
        	'login' => $login,
        	'password' => $password,
        	'mail' => $mail,
          'adresse' => '',
          'id' => $id,
          'role' => $role
        	));
      }
      else {
        echo "Erreur inconnue";
      }
  }
?>
