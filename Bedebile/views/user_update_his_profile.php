<?php ob_start(); ?>
<div class="container">
  <div class="row">
  <div class="col-md-10">
  <fieldset>
  <legend><h1>Edition du profil</h1></legend>
  <?=$ERROR["UPDATEUSER"];?>
  <?=$SUCCES["UPDATEUSER"];?>
  <form class="form-horizontal" action="#" method="post">
  <div class="form-group">
    <label class="col-md-4 control-label" for="Login">Login</label>
    <div class="col-md-4">
   <div class="input-group">
         <div class="input-group-addon">
          <i class="fa fa-user">
          </i>
        <input type="text" hidden name="login_update_default" value="<?=$user['user_login']?>"><br>
         </div>
         <input id="login_update" name="login_update" type="text" value="<?=$user['user_login']?>" class="form-control input-md">
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="Name">Nom</label>
    <div class="col-md-4">
   <div class="input-group">
         <div class="input-group-addon">
          <i class="fa fa-user">
          </i>
         </div>
         <input id="name_update" name="name_update" type="text" value="<?=$user['user_name']?>" class="form-control input-md">
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="Firstname">Prénom</label>
    <div class="col-md-4">
   <div class="input-group">
         <div class="input-group-addon">
          <i class="fa fa-user">
          </i>
         </div>
         <input id="firstname_update" name="firstname_update" type="text" value="<?=$user['user_firstname']?>" class="form-control input-md">
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="Adresse">Adresse</label>
    <div class="col-md-4">
   <div class="input-group">
         <div class="input-group-addon">
          <i class="fa fa-user">
          </i>
         </div>
         <input id="Adresse" name="adresse_update" type="text" value="<?=$user['user_adresse']?>" class="form-control input-md">
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="Phone number ">Numéro de telephone</label>
    <div class="col-md-4">
      <div class="input-group">
           <div class="input-group-addon">
         <i class="fa fa-phone"></i>
           </div>
        <input id="phonenumber_update" name="phonenumber_update" type="text" value="<?=$user['user_tel']?>" class="form-control input-md">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="email_update">Adresse email</label>
    <div class="col-md-4">
    <div class="input-group">
         <div class="input-group-addon">
       <i class="fa fa-envelope-o"></i>
        <input type="text" hidden name="email_update_default" value="<?=$user['user_email']?>"><br>
         </div>
          <input id="email_update" name="email_update" type="text" value="<?=$user['user_email']?>" class="form-control input-md">
        </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" for="password_update">Mot de passe</label>
    <div class="col-md-4">
      <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-envelope-o"></i>
        </div>
        <input id="password_update" name="password_update" type="password" placeholder="Mot de passe" class="form-control input-md">
        <input id="password_verify_update" name="password_verify_update" type="password" placeholder="Confirmation mot de passe" class="form-control input-md">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-4 control-label" ></label>
    <div class="col-md-4">
      <button class="btn btn-success" type="submit" name="update-user"><span class="glyphicon glyphicon-thumbs-up"></span> Submit</button>
    </div>
  </div>
  </form>
  </fieldset>
  </div>
  </div>
</div>

  <?php
  $title = "Editer mon profil";
  $content = ob_get_clean();
  include 'includes/layout.php'; ?>
