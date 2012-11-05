/**
 * Created with JetBrains PhpStorm.
 * User: KESSILER
 * Date: 17/09/12
 * Time: 01:00
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
    $("ul.sf-menu").sooperfish();
    $("#login .submit").click(function () {
        $("#login").validationEngine();
    })
    $("#dieta .submit").click(function () {
        $("#dieta").validationEngine();
    })
    $("#produto .submit").click(function () {
        $("#produto").validationEngine();
    })
    $("#cadastro_vovo .submit").click(function () {
        $("#cadastro_vovo").validationEngine();
    })
    slideShow(4000);
});

function openPopUp() {
    $.fx.speeds._default = 500;
    $( "#dialog-form" ).dialog({
        autoOpen: false,
        show: "blind",
        hide: "explode",
        height: 500,
        width: 350,
        modal: true,
        buttons: {
            Fechar: function() {
                $( this ).dialog( "close" );
            }
        }
    });
    $( "#dialog-form" ).dialog( "open" );
}

function slideShow(speed) {
    $('ul.images').append('<li id="slideshow-caption" class="caption"><div class="slideshow-caption-container"><p></p></div></li>');
    $('ul.images li').css({opacity:0.0});
    $('ul.images li:first').css({opacity:1.0}).addClass('show');
    var timer = setInterval('gallery()', speed);
    $('ul.images').hover(
        function () {
            clearInterval(timer);
        },
        function () {
            timer = setInterval('gallery()', speed);
        }
    );
}

function gallery() {
    var current = ($('ul.images li.show') ? $('ul.images li.show') : $('#ul.images li:first'));
    if (current.queue('fx').length == 0) {
        var next = ((current.next().length) ? ((current.next().attr('id') == 'slideshow-caption') ? $('ul.images li:first') : current.next()) : $('ul.images li:first'));
        var desc = next.find('img').attr('alt');
        next.css({opacity:0.0}).addClass('show').animate({opacity:1.0}, 1000);
        current.animate({opacity:0.0}, 1000).removeClass('show');
    }
}