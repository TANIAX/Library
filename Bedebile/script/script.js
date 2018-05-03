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

    $("a.infobulle").mouseover(function(){
        if($(this).attr("title")=="") return false;

        $("body").append('<span class="infobulle"></span>');
        var bulle = $(".infobulle:last");
        bulle.append($(this).attr("title"));
        //$(this).attr("title","");
        var posTop = $(this).offset().top-$(this).height();
        var posLeft = $(this).offset().left+$(this).width()/2-bulle.width()/2;
        bulle.css({
            left:posLeft,
            top:posTop-20,
            opacity:0
        });
        bulle.animate({
            top:posTop-10,
            opacity:0.99
        });
    });

    $("a.infobulle").mouseout(function(){
        var bulle = $(".infobulle:last");
        console.log(bulle.text());
        //$(this).attr("title",bulle.text());
        bulle.animate(
            {
                top:bulle.offset().top+10,
                opacity:0
            },
            500,
            "linear",
            function(){
                bulle.remove();
            }
        );
    });
});
