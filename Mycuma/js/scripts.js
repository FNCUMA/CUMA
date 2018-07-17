/**************************************************************************/
/*               carousel page d'acceuil avec animation                   */
/**************************************************************************/

$(document).ready(function($) {


    if (document.getElementById("slider-01"))
    {
        var $myCarousel = $('.carousel');

        // starts the carousel
        $myCarousel.carousel({
            interval: 5000
        });

        $myCarousel.on('slide.bs.carousel', function (e)
        {
            var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
            doAnimations($animatingElems);
        });

        var $firstAnimatedElement = $myCarousel.find(".carousel-item:first").find("[data-animation ^= 'animated']");

        doAnimations($firstAnimatedElement);

        function doAnimations(elems)
        {
            var animEndEv = 'webkitAnimationEnd mozAnimationEnd MsAnimationEnd oanimationend animationend';
            elems.each(function()
            {
                var $this = $(this);
                $animationType = $this.date('animation');
                $this.addClass($animationType).one(animEndEv, function()
                {
                    $this.removeClass($animationType);
                });
            }); // fin du each
        } // doAnimations
    }





});

/**************************************************************************/
/*               tooltip pour posts                   */
/**************************************************************************/

$( function () {
  $('[data-toggle="tooltip"]').tooltip()
});

/**************************************************************************/
/*               class pour styliser le formulaire              */
/**************************************************************************/

$( function()
{
    $('form.wpcf7-form').addClass('col d-flex flex-column px-0 justify-content-around align-items-center');
    $('input[name="your-name"].wpcf7-form-control').addClass('form-control form-control-lg mt-4 mb-1 bg-light border-0');
    $('input[name="your-email"].wpcf7-form-control').addClass('form-control form-control-lg mb-1 bg-light border-0');
    $('input[name="your-telephone"].wpcf7-form-control').addClass('form-control form-control-lg mb-1 bg-light border-0');
    $('input[name="your-subject"].wpcf7-form-control').addClass('form-control form-control-lg mb-1 bg-light border-0');
    $('textarea[name="your-message"]').addClass('form-control form-control-lg mb-1 bg-light border-0').css('resize','none');
    $('input[type="submit"].wpcf7-form-control').addClass('text-center mb-4 btn bg-cuma text-white d-block mx-auto');
    $('form.wpcf7-form > p').addClass('d-flex flex-column');
    $('#wpcf7-f5-p10-o1 > form > div.wpcf7-response-output.wpcf7-mail-sent-ok.animated').addClass('bounce alert alert-success p-3');
    $('#wpcf7-f5-p10-o1 > form > div.wpcf7-response-output.wpcf7-validation-errors.animated').addClass('bounce alert alert-warning p-3');
  

});

/**************************************************************************/
/*               Ajout de la class 'active' sur la pagination          */
/**************************************************************************/

$( function()
{
    $('nav > ul > li > a.page-link > .current').parent().parent().addClass('active').removeClass('border');
    $('nav > ul > li > a.page-numbers').addClass('p-3 h-100');
    $('nav > ul > li.next-list-item > a').addClass('p-3 h-100');
    $('nav > ul > li.prev-list-item > a').addClass('p-3 h-100');
});

/**************************************************************************/
/*               Ajout de la class bootstrap 'embed-responsive-item' sur la video         */
/**************************************************************************/

$( function()
{
    $('main > section > div > div.embed-responsive.embed-responsive-16by9 > iframe').addClass('embed-responsive-item');
});

/**************************************************************************/
/*     Supprimer une classe en fonction de la taille de l'écran                */
/**************************************************************************/

$( window ).resize(function() {
    if ( $(window).width() > 577 )
    {
        // parti navbar navbar
        $('.sidebar-nav').removeClass('w-100');
        $('.sidebar-nav > .float-right').addClass('w-50').removeClass('w-100');
        $('#menu-item-219 > ul').addClass('wrapperppi').removeClass('mt-5');
        $('ul.dropdown-menu a.dropdown-item').removeClass('py-3 px-0 justify-content-center bg-white');
        $('ul.dropdown-menu').removeClass('bg-white');
    }
    else
    {
        $('.sidebar-nav > .float-right').addClass('w-100').removeClass('w-50');
        $('#menu-item-219 > ul').removeClass('wrapperppi').addClass('mt-5');
        $('ul.dropdown-menu a.dropdown-item').addClass('py-3 px-0 justify-content-center bg-white');
        $('ul.dropdown-menu').addClass('bg-white');


    }
});

$( function() {
    if ( $(window).innerWidth() > 577 )
    {
        // parti navbar navbar
        $('.sidebar-nav').removeClass('w-100');
        $('.sidebar-nav > .float-right').addClass('w-50').removeClass('w-100');
        $('#menu-item-219 > ul').addClass('wrapperppi').removeClass('mt-5');
        $('ul.dropdown-menu a.dropdown-item').removeClass('py-3 px-0 justify-content-center bg-white');
        $('ul.dropdown-menu').removeClass('bg-white');



    }
    else
    {
        $('.sidebar-nav > .float-right').addClass('w-100').removeClass('w-50');
        $('#menu-item-219 > ul').removeClass('wrapperppi').addClass('mt-5');
        $('ul.dropdown-menu a.dropdown-item').addClass('py-3 px-0 justify-content-center bg-white');
        $('ul.dropdown-menu').addClass('bg-white');


    }

});

/**************************************************************************/
/*     Resize picture's article and carousel slider               */
/**************************************************************************/
$( function() {
    if ($(window).innerWidth() > 770 )
    {
        // picture's article
        $('body > main > section.row > ul > li > a > div.card > img.img-fluid').addClass('card-img-top');

        // carousel slider's article recent
        $('#slider-01').addClass('resize_slider');

        $('#slider-01').removeClass('resize_slider_xs');
    }
    else
    {
        // picture's article
        $('body > main > section.row > ul > li > a > div.card > img.img-fluid').removeClass('card-img-top');

        // carousel slider's article recent
        $('#slider-01').removeClass('resize_slider');

        $('#slider-01').addClass('resize_slider_xs');


    }
});

$( window ).resize(function() {
    if ( $(window).width() > 770 )
    {
        // picture's article
        $('body > main > section.row > ul > li > a > div.card > img.img-fluid').addClass('card-img-top');

        // carousel slider's article recent
        $('#slider-01').addClass('resize_slider');

        // carousel slider's article recent
        $('#slider-01').removeClass('resize_slider_xs');
    }
    else
    {
        // picture's article
        $('body > main > section.row > ul > li > a > div.card > img.img-fluid').removeClass('card-img-top');

        $('#slider-01').removeClass('resize_slider');

        // carousel slider's article recent
        $('#slider-01').addClass('resize_slider_xs');


    }
});

/**************************************************************************/
/*     Ajout de la class dans les slider pour afficher l'extrait du texte             */
/**************************************************************************/

$(function($) {
    $('#slider-01 > div > div > a > div > p').addClass('d-none d-lg-block');
});

/**************************************************************************/
/*     Menu latéral               */
/**************************************************************************/

$(function($) {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        if ($(window).innerWidth() < 577)
        {
            $('.sidebar-nav').toggleClass("w-100");

        }
        $("#wrapper").toggleClass("toggled");

        $("span.navbar-toggler-icon").toggleClass("invisible");
        $("span.icon-cross").toggleClass("invisible");

        $("main *").toggleClass("d-none");
        $("body > footer").toggleClass("d-none");
    });
});

$(function($) {
    $('ul.dropdown-menu').on('hide.bs.dropdown', function() {
        $('ul.dropdown-menu').removeClass('animated fadeInLeft');
    });
});


/**************************************************************************/
/*     Menu latéral en mode smartphone           */
/**************************************************************************/
// alongement de la sidebar
// suppression de la class h-1 de bootstrap

$(function () {
    if ($(window).innerWidth() < 577 )
    {
        $('#sidebar-wrapper').removeClass('h-100').addClass('bg-cuma').css('height', 80+'rem');
    }
    else
    {
        $('#sidebar-wrapper').addClass('h-100').removeClass('bg-cuma');
    }
});

$( window ).resize(function() {
    if ($(window).width() < 577 )
    {
        $('#sidebar-wrapper').removeClass('h-100').addClass('bg-cuma').css('height', 80+'rem');
    }
    else
    {
        $('#sidebar-wrapper').addClass('h-100').removeClass('bg-cuma');

    }
});


/**************************************************************************/
/*     animation dans le carousel           */
/**************************************************************************/

// var classes = ['bounce','flash','pulse','rubberBand','shake','headShake','swing','tada','wobble','jello','jackInTheBox','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','flipInX','flipInY','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','rollIn','zoomIn','zoomInDown','zoomInLeft','zoomInRight','zoomInUp','slideInDown','slideInLeft','slideInRight','slideInUp'];
var classes = ['flash','pulse','fadeIn'];
var allElements = ['main > section > ul > li > a > div > img', '#homepage > section'];

$('main *').each(function(){
    $(this).toggleClass('animated');
    $(this).addClass( classes.splice( ~~(Math.random()* classes.length), 1 )[0]);
});
