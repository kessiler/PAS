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
    $("#EntradaAtivos .submit").click(function () {
        $("#EntradaAtivos").validationEngine();
    })
    $("#SaidaAtivos .submit").click(function () {
        $("#SaidaAtivos").validationEngine();
    })
    $("#cadastro_vovo .submit").click(function () {
        $("#cadastro_vovo").validationEngine();
    })
    $("#logativos .submit").click(function () {
        $("#logativos").validationEngine();
    })
    slideShow(4000);
});

function datePicker(div) {
    $(div).datepicker({
        showOn: "button",
        buttonImage: "./templates/default/images/date_picker.jpg",
        buttonImageOnly: true,
        dateFormat: 'dd/mm/yy',
        nextText: 'Próximo',
        prevText: 'Anterior',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
}

function openPopUp() {
    $.fx.speeds._default = 500;
    $( "#dialog-form" ).dialog({
        autoOpen: false,
        show: "blind",
        hide: "fade",
        height: 726,
        width: 550,
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

function mask(campo, evt, mask) {

    if(document.all) {
        key = evt.keyCode; }
    else{
        key = evt.which;
    }
    if (key == 8) {
        return true;
    }
    string = campo.value;
    i = string.length;

    if (i < mask.length) {
        if (mask.charAt(i) == '?') {
            return (key > 47 && key < 58);
        } else {
            if (mask.charAt(i) == '!') {  return true;  }
            for (c = i; c < mask.length; c++) {
                if (mask.charAt(c) != '?' && mask.charAt(c) != '!')
                    campo.value = campo.value + mask.charAt(c);
                else if (mask.charAt(c) == '!'){
                    return true;
                } else {
                    return (key > 47 && key < 58);
                }
            }
        }
    } else return false;
}