function setCookie(name,value,days){var date,expires;if(days){date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));expires="; expires="+date.toGMTString();}else{expires="";}
document.cookie=name+"="+value+expires+"; path=/";}
function getCookie(cname){var name=cname+"=";var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' ')c=c.substring(1);if(c.indexOf(name)!=-1){return c.substring(name.length,c.length);}}
return "";}
function player_responsive() {
        width = $('.player_wraper').width();
        height = (width * 9 ) / 16;
        height = (height > 200) ? (height - 120) : (height + 100);
        $('#player_wrapper').css('height', height + 'px');
    }
function binplay(h) {
        var image = '<div class="loading"><div><i class="fa-li fa fa-spinner fa-spin"></i> Vui lòng chờ trong giây lát ...</div></div>';
        jQuery("#media-player-box").html(image);
        jQuery.ajax({
            type: "POST",
            url: base_url + "binplay.php",
            data: {
            qcao: h
            },
            success: function(data) {
                jQuery("#media-player-box").html(data);
                 setTimeout(function(){player_responsive();}, 200);
            }
        });
}