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
//Cette fonction vérifie si l'email existe déjà
function getUserByMail($email) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT user_email FROM users WHERE user_email = :email');
    $reponse->execute(array('email' => $email));
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
    return $donnees;
}
//Cette fonction récupere toutes les données de tout les utilisateurs
function getUsers() {
    $bdd = getDb();
    $reponse = $bdd->query('SELECT * FROM users');
    $donnees = $reponse->fetchAll();
    $reponse->closeCursor();
    return $donnees;
}
//Cette fonction va chercher le mot de passe d'un utilisateur en particulier .
function getPassword($login) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT user_password FROM users WHERE user_login = :login');
    $reponse->execute(array('login' => $login));
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
    return $donnees;
}

//Cette fonction ajoute un nouvelle utilisateur
function newUser($login,$password,$mail,$name,$firstname,$adresse,$tel){
  $bdd = getDb();

  $query = "INSERT INTO users (user_name, user_firstname, user_login, user_adresse, user_password , user_email, user_role, user_tel) VALUES('$name','$firstname','$login' ,'$adresse' , '$password' , '$mail', '2', '$tel')";
  $transaction = $bdd->prepare($query); // Faire cela s'appele une transaction.
  $transaction->execute();
  return $transaction;
  }

//Je me souviens pas pq j'ai fais ça
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
//Cette fonction supprime un utilisateur sur base de l'id
function deleteUser($id) {
    $bdd = getDb();
    $reponse = $bdd->prepare('DELETE FROM users WHERE user_id = :id;');
    $reponse->execute(array('id' => $id));
    $reponse->closeCursor(); // Termine le traitement de la requête
}
//Cette fonction récupere toutes les données d'un utilisateur par l'id
function getUserById($id) {
    $bdd = getDb();
    $reponse = $bdd->prepare('SELECT * FROM users WHERE user_id = :id');
    $reponse->execute(array('id' => $id));
    $donnees = $reponse->fetch();
    $reponse->closeCursor();
    return $donnees;
}

//Cette fonction mets à jours un utilisateur
function updateUser($name,$firstname,$login, $password,$mail,$adresse,$id,$role,$tel){
  $bdd = getDb();
  //L'adresse n'étant pas requise je divise la requete en deux
  if (!empty($adresse)) {
    $req = $bdd->prepare('UPDATE users SET user_name =:name, user_firstname =:firstname,user_login = :login, user_password = :password, user_email = :mail ,user_adresse = :adresse, user_role =:role, user_tel =:tel WHERE user_id = :id ');
    $req->execute(array(
      'name' => $name,
      'firstname' => $firstname,
    	'login' => $login,
    	'password' => $password,
    	'mail' => $mail,
      'adresse' => $adresse,
      'id' => $id,
      'role' => $role,
      'tel' => $tel
    	));
  }
    else {
      $req = $bdd->prepare('UPDATE users SET user_name =:name, user_firstname =:firstname, user_login = :login, user_password = :password, user_email = :mail ,user_adresse = :adresse, user_role =:role, user_tel =:tel WHERE user_id = :id ');
      $req->execute(array(
        'name' => $name,
        'firstname' => $firstname,
      	'login' => $login,
      	'password' => $password,
      	'mail' => $mail,
        'adresse' => '',
        'id' => $id,
        'role' => $role,
        'tel' => $tel
      	));
    }
  }
?>
