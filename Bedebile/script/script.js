 function openNav() {
    document.getElementById("mySidenav").style.width = "70%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    //document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //document.body.style.backgroundColor = "rgba(0,0,0,0)";
}
/*Login*/
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
});

/*Liste commande*/
$(document).ready(function() {
    $('[id^=detail-]').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    });
});




/*infobulle*/
$(function(){
    /*Affichage de l'infobulle*/
    //On selection tout les liens qui ont la classe articleInfo, au survole
    $("a.articleInfo").mouseover(function(){
      //On sort les liens avec la class articleInfo qui on le contenu de title vide, (la fonction n'ia pas plus loin grâce au return )
        if($(this).attr("title")=="") return false;
        //On ajoute au code html la balise span qui contient une class infobulle
        $("body").append('<span class="infobulle"></span>');
        // On stock dans une variable l'infobulle
        var bulle = $(".infobulle:last");
        // On recupere le titre du lien
        bulle.append($(this).attr("title"));
        //$(this).attr("title","");
        //Position de l'infobulle , la fonction offset nous donne la position par rapport à la page
        var posTop = $(this).offset().top-$(this).height();
        //Pareille
        var posLeft = $(this).offset().left+$(this).width()/2-bulle.width()/2;
        //On place la bulle selon les variable déclarée ci-dessus
        bulle.css({
            left:posLeft,
            top:posTop-200,
            opacity:0
        });
        //On annime l'infobulle grace à animate
        bulle.animate({
          //On remonte un peu l'infobulle
            top:posTop -10,
            //On ne met pas l'opacité à 1 car cela peut bugger sous firefox
            opacity:0.99
        });
    });
    /*Suppression de l'infobulle*/
    $("a.articleInfo").mouseout(function(){
        var bulle = $(".infobulle:last");
        //$(this).attr("title",bulle.text());
        bulle.animate(
            {
                top:bulle.offset().top+10,
                opacity:0
            },
            //Temps en milliseconde de l'annimation de l'infobulle
            500,
            "linear",
            function(){
                //Suppression de l'infobulle du code html grâce à la fonction remove
                bulle.remove();
            }
        );
    });
});
