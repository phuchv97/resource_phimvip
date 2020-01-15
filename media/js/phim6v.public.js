function setCookie(name,value,days){var date,expires;if(days){date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));expires="; expires="+date.toGMTString();}else{expires="";}
document.cookie=name+"="+value+expires+"; path=/";}
function getCookie(cname){var name=cname+"=";var ca=document.cookie.split(';');for(var i=0;i<ca.length;i++){var c=ca[i];while(c.charAt(0)==' ')c=c.substring(1);if(c.indexOf(name)!=-1){return c.substring(name.length,c.length);}}
return "";}
function binplay(h) {
        var image = '<img class="player_loading" src="https://i.imgur.com/AAZ8bge.gif"/>';
        jQuery("#media-player-box").html(image);
        jQuery.ajax({
            type: "POST",
            url: base_url + "binplay.php",
            data: {
            qcao: h
            },
            success: function(data) {
                jQuery("#media-player-box").html(data);
                jQuery('html, body').animate({
                    scrollTop: jQuery("#media-player-box").offset().top
                }, 500);
            }
        });
}
