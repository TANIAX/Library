<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?php echo $title ?></title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="<?=URL?>css/style.css" rel="stylesheet" type="text/css"></link>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">

  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="<?=URL?>script/script.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
  <?php
  include 'header.php';
  include 'content.php';
  include 'footer.php';
  ?>

</body>
</html>
