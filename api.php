<?php
require('./simple_html_dom.php');
function explode_by($begin,$end,$data) {
    $data = explode($begin,$data);
    $data = explode($end,$data[1]);
    return $data[0];
}
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'hackcaigi';
    $secret_iv = 'hacklamcho';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

            $urlphim = trim($_GET['url']);
            $unurl = encrypt_decrypt('decrypt', $urlphim);
            $idvideo = explode('video', $unurl);
            $hdngay = $idvideo[1];
            $iduser = explode_by('video','_',$unurl);
            if($iduser == '503011223'){
                $email = 'ngockhungcute@gmail.com';
                $pass = 'khanhbilly';
                $cookie = 'cookie.txt';
            }

                $auth_url = "https://m.vk.com";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $auth_url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $login_page = curl_exec($ch);
                curl_close($ch);

                $html = str_get_html($login_page);
                $login_url = $html->find("form",0)->action;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $login_url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ["email"=>$email, "pass"=>$pass]);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($ch);
                curl_close($ch);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $unurl);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $page = curl_exec($ch);
                curl_close($ch);
                $html = iconv('windows-1251','utf-8',$page);
                $hd360 = explode_by('"url360":"','"',$html);
                if ($hd360) {
                   $link360 = '{"file":"'.$hd360.'","type":"mp4","label":"360p"},';
                }
                $hd480 = explode_by('"url480":"','"', $html);
                if ($hd480) {
                   $link480 = '{"file":"'.$hd480.'","type":"mp4","label":"480p"},';
                }
                $hd720 = explode_by('"url720":"','"', $html);
                if ($hd720) {
                   $link720 = '{"file":"'.$hd720.'","type":"mp4","label":"720p"},';
                }
                $hd1080 = explode_by('"url1080":"','"', $html);
                if ($hd1080) {
                   $link1080 = '{"file":"'.$hd1080.'","type":"mp4","label":"1080p"},';
                }
                $js = $link360.$link480.$link720.$link1080;

?>
<!DOCTYPE html><html><head> <meta charset="UTF-8"> <title>video by Bongngo.Net</title>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
 <script type="text/javascript" src="https://biphim.net/player/playerbiphim.js"></script>
<script type="text/javascript">jwplayer.key="MBvrieqNdmVL4jV0x6LPJ0wKB/Nbz2Qq/lqm3g==";</script>
<style>
.jw-rightclick { display: none !important; }
.jw-progress {
            background-color: #ba400e!important;
 }
 .jw-icon-rewind
 {
     display:none!important;
 }
.jw-time-tip::after, .jw-controlbar .jw-tooltip::after, .jw-settings-menu .jw-tooltip::after {
    background-color: #000000!important;
}

.jw-time-tip .jw-text, .jw-controlbar .jw-tooltip .jw-text, .jw-settings-menu .jw-tooltip .jw-text {
    background-color: #000000!important;
    color: #fdfdfd!important;
}
.jw-skin-seven .jw-background-color {
    background-color: rgba(0, 0, 0, .6) !important;
    font-size: 16px!important;
    text-shadow: 1px 1px 2px #000;
}
.jw-skin-seven .jw-text-duration {
    color: #fff !important
}
.jw-slider-time.jw-background-color {
    background: 0 0 !important
}
.jw-skin-seven .jw-rail {
    background: #666f82 !important
}
.jw-skin-seven .jw-buffer {
    background: #000 !important
}
.jwplayer.jw-flag-aspect-mode {
    height: 100% !important;
}
</style>
</head>
 <body>
    <div id="mediaplayer"></div><script type="text/javascript">
    var reloadTimes = 0;
    var playerInstance = jwplayer("mediaplayer");
    var sources = [<?=$js?>];
    function load_vtvplayer(sources) {
        playerInstance.setup({
            sources: sources,
            width: "100%",
            aspectratio: "16:9",
            primary: "html5",
            image: "/view.png",
            autostart: false,
            events: {
                onAdPlay: function() {
                    playerInstance.setVolume(30);
                },
                onAdSkipped: function() {
                    playerInstance.setVolume(100);
                },
                onAdComplete: function() {
                    playerInstance.setVolume(100);
                }
            }
        });
        playerInstance.addButton(
                  "/player/forward3.svg",
                  "Tua tiến 10s",
                  function() {
                    playerInstance.seek(playerInstance.getPosition()+10);
                  },
                  "Tua tiến 10s"
                );
                playerInstance.addButton(
                  "/player/backward2.svg",
                  "Tua lại 10s",
                  function() {
                    playerInstance.seek(playerInstance.getPosition()-10);
                  },
                  "Tua lại 10s"
                );
            playerInstance.on("error", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById('mediaplayer');
                if (message["message"] == "Loi Load Phim: Nguon Phim Loi Vui Long Chon Sever Khac") {
                    setTimeout(function () {
                    element.innerHTML='<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />'
                    }, 100);
                }
                else
                    {
                    element.innerHTML='<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />'
                    }
            }
        });

        playerInstance.on("setupError", function (message) {
            if ((reloadTimes < 5)) {
                reloadTimes = reloadTimes + 1;
                setTimeout(function () {
                    playerInstance.remove();
                    load_biplayer();
                }, 1500);
            } else {
                var element=document.getElementById('mediaplayer');
                if (message["message"] == "No suitable players found and fallback disabled") {
                    setTimeout(function () {
                    element.innerHTML='<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />'
                    }, 100);
                }
                else
                    {
                    element.innerHTML='<img src="https://i.imgur.com/J9OoJl1.jpg" style="width:100%;height:100%;" />'
                    }
            }
        });
    }
    var image='<img class="player_loading" src="https://i.imgur.com/AAZ8bge.gif"/>';
    jQuery("mediaplayer").html(image);
    $(document).ready(function() {
        load_vtvplayer(sources);
    })
</script></body></html>