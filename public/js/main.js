
function formTipoPessoa(val) {    
    if( val == 1 ){
        $('#pessoa_juridica').hide();
        $('#pessoa_fisica').show();
    } else if (val == 2) {
        $('#pessoa_juridica').show();
        $('#pessoa_fisica').hide();
    } else {
        $('#pessoa_juridica').hide();
        $('#pessoa_fisica').hide();
    }
}

function ajaxPost(url, div) {
    var params = $('form').serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: params,
        beforeSend: function() {
        },
        success: function(txt) {                       
           $("#" + div).html(txt);         
        },
        error: function(txt) {
        }
    });
}

$(function() {
    $( ".date" ).datepicker();
});

/* Brazilian initialisation for the jQuery UI date picker plugin. */
/* Written by Leonildo Costa Silva (leocsilva@gmail.com). */
jQuery(function($){
        $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
});

