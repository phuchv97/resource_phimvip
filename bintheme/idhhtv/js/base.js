$(document).ajaxStart(function() {
    $.blockUI({
        message: '<h4>Vui lòng đợi .....</h4>',
        css: {
            border: 'none',
            padding: '15px',
            textalign: 'center',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .8,
            color: '#fff'
        }
    });
}).ajaxStop($.unblockUI);
$(document).ready(function() {
    if (screen.width <= 1024) {
        $('.avatar').click(function() {
            $('.user-section .tip-dropdown').fadeToggle("fast");
        });
    } else {
        $('.avatar').mouseover(function() {
            $('.user-section .tip-dropdown').show();
        });
        $('.avatar').mouseout(function() {
            $('.user-section .tip-dropdown').hide();
        });
    }
    $("#cardType a").click(function(e) {
        e.preventDefault();
        goToByScroll($(this).attr("id"));
    });
    $("[data-toggle=tooltip]").tooltip();
});
$(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    }
    $('.modal').on('show.bs.modal', reposition);
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});

function setIntervalToRedirectPage(url) {
    var myVar = setInterval(function() {
        myTimer()
    }, 1000);

    function myTimer() {
        var time = $('#timeinteval').text() * 1;
        if (time > 0) {
            $('#timeinteval').text(time - 1);
        } else {
            clearInterval(myVar);
            window.location = url;
        }
    }
}

function goToByScroll(id) {
    id = id.replace("_option", "");
    $('html,body').animate({
        scrollTop: $("#" + id).offset().top
    }, 'slow');
}