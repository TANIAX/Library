<?php ob_start() ?>
<div class="container">
    <div class="row">
        <!-- Carousel -->
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="https://www.bede.fr/media/librairies/x207.jpg.pagespeed.ic.kJ2fCMikf4.jpg"
                         alt="First slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Bienvenue chez<strong> Bédébile</strong></span>
                            </h2>
                            <br>
                            <h3>
                                <span>Ce site est en cours de construction</span>
                            </h3>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="https://mtaregion.com/wp-content/uploads/background_librairie-poirier.jpg"
                         alt="Second slide">
                    <!-- Static Header -->
                    <div class="header-text hidden-xs">
                        <div class="col-md-12 text-center">
                            <h2>
                                <span>Achetez<strong> En ligne</strong></span>
                            </h2>
                            <br>
                            <h3>
                                <span>Faites vous livre en <strong> 24h !</strong></span>
                            </h3>
                        </div>
                    </div><!-- /header-text -->
                </div>
                <div class="item">
                    <img src="https://i.ytimg.com/vi/IWh7rVGm_aI/maxresdefault.jpg" alt="Third slide">
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!-- /carousel -->
    </div>
</div>
<?php
$title = 'Accueil';
$content = ob_get_clean();
include 'includes/layout.php';
?>
