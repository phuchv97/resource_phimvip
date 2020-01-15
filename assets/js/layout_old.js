jQuery(document).ready(function($) {

    $('.LightOff').click(function() {
        if ($(this).hasClass('LightOn')) {
            $(this).removeClass('LightOn').html('<span class="glyphicon glyphicon-off"></span> &nbsp; ' + webLanguage.Light_Off);
            $('#media-player,#mediaplayer').css({
                'z-index': 0
            });
            $(".screen-off").css('display','none');
            $('#overlayPlayer').fadeOut();
            return false;
        }
        $(this).addClass('LightOn').html('<span class="glyphicon glyphicon-bell"></span> &nbsp; ' + webLanguage.Light_On);
        $('#media-player,#mediaplayer').css({
            'z-index': 9999999
        });
        $(".screen-off").css('display','block');
        $(".LightOff").css("zIndex",1000);
        $(this).css("position",'relative');
        $('#overlayPlayer').fadeIn();
        return false;
    });
	$('.CloseAds').click(function() {
		$('.qc_biphim').css('display','none');
        return false;
    });

});


function Ads(h) {
        var image = '<img class="player_loading" src="https://i.imgur.com/AAZ8bge.gif"/>';
        jQuery("#media-player").html(image);
        jQuery.ajax({
            type: "POST",
            url: base_url + "ads.php",
            data: {
            qcao: h
            },
            success: function(data) {
                jQuery("#media-player").html(data);
                jQuery('html, body').animate({
                    scrollTop: jQuery("#media-player").offset().top
                }, 500);
            }
        });
}
function downloadFilm(){
    $('#block-download').fadeIn('slow')
    $('html, body').animate({
        scrollTop: $("#block-download").offset().top
    }, 500);
}