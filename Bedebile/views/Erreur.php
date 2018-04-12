<?php ob_start(); ?>
<div class="error">
  <div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
  <h3 class="font-bold">We couldn't find the page..</h3>

  <div class="error-desc">
    Sorry, but the page you are looking for was either not found or does not exist. <br/>
    Try refreshing the page or click the button below to go back to the Homepage.
    <div>
      <a class=" login-detail-panel-button btn" href="http://www.vmware.com/">
        <i class="fa fa-arrow-left"></i>
        Go back to Homepage
      </a>
    </div>
  </div>
</div>
<?php
$title = "Erreur";
$content = ob_get_clean();
include 'includes/layout.php'; ?>
