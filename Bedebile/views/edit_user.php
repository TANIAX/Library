<?php ob_start(); ?>
<div class="updateuser">
  <form  action="update_user" method="post">
    <input hidden type="text" name="id_update" value="<?=$user['user_id']?>"><br>
    <br><p>Login:</p>
    <input type="text" hidden name="login_update_default" value="<?=$user['user_login']?>"><br>
    <input type="text" name="login_update" value="<?=$user['user_login']?>"><br>
    <br><p>Email :</p>
    <input type="text" hidden name="email_update_default" value="<?=$user['user_email']?>"><br>
    <input type="text" name="email_update" value="<?=$user['user_email']?>"><br>
    <br><p>Password :</p>
    <input type="password" name="password_update" value=""><br>
    <br><p>Verification password :</p>
    <input type="password" name="password_verify_update" value=""><br>
    <br><p>Adresse :</p>
    <input type="text" name="adresse_update" value="<?=$user['user_adresse']?>"><br>
    <br><p>rôle :
    <select name="role_update">
      <option value="2">Membre</option>
      <option value="1">Admin</option>
    </select></p>
      <button type="submit" value="Submit">Submit</button>
  </form>

</div>
<?php
$title = "Edition utilisateur";
$content = ob_get_clean();
include 'includes/layout.php'; ?>
