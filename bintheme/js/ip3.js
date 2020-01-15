
(function($) {
    var bodyTag = $('body'),
        mySlidebars;
    $.fn.bootstrapButton = $.fn.button;
    $.fn.bootstrapTooltip = $.fn.tooltip;
    BootstrapDialog.defaultOptions.nl2br = false;
    BootstrapDialog.defaultOptions.type = BootstrapDialog.TYPE_DEFAULT;
    var _setIntervalProgress;
    var blockUiConfig = {
        message: 'Loading...',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    };
    window.showAlert = function(_message, callback, title, options) {
        $.each(BootstrapDialog.dialogs, function(id, dialog) {
            dialog.close();
        });
        if (typeof title == 'undefined') {
            title = 'Thông báo';
        }
        if (typeof options == 'undefined') {
            options = {};
        }

        options = $.extend(true, {
            title: title,
            message: _message,
            type: BootstrapDialog.TYPE_WARNING,
            callback: callback,
            buttonLabel: 'Ok baby'
        }, options);
        BootstrapDialog.alert(options);
    };
    var loadedShowLoadingPage = false,
        bodyTag = $('body'),
        scrollTrigger = 100,
        afterAjaxLoad = function() {
            bodyTag = $('body');
            $('[data-toggle="tooltip"]', bodyTag).tooltip();
            $('[data-toggle="dropdown"]', bodyTag).dropdown();
            $('input[data-type]', bodyTag).each(function() {
                $(this).attr('type', $(this).data('type'));
            });
            $('select.select2', bodyTag).each(function() {
                if (!$(this).data('select2')) {
                    var ob_config = $(this).data();
                    ob_config.with = '100%';
                    $(this).select2(ob_config);
                }

            });
            loadBackToTop();
            if (typeof FB != 'undefined' && typeof FB.XFBML != 'undefined') {
                FB.XFBML.parse();
            }
            if ($("#slider-container", bodyTag).length > 0) {
                $("#slider-container", bodyTag).wowSlider({
                    effect: "louvers",
                    duration: 20 * 100,
                    delay: 20 * 100,
                    width: 960,
                    height: 360,
                    autoPlay: true,
                    autoPlayVideo: false,
                    playPause: true,
                    stopOnHover: false,
                    loop: false,
                    bullets: 1,
                    caption: true,
                    captionEffect: "parallax",
                    controls: true,
                    controlsThumb: false,
                    responsive: 2,
                    fullScreen: false,
                    gestures: 2,
                    onBeforeStep: 0,
                    images: 0
                });
            }

            $('.has-slide .block-items').each(function() {
                $(this).owlCarousel({
                    loop: true,
                    margin: 10,
                    dots: false,
                    items: 4,
                    nav: true,
                    responsive: {
                        0: {
                            items: 4
                        },
                        299: {
                            items: 2
                        },
                        319: {
                            items: 2
                        },
                        479: {
                            items: 3
                        },
                        767: {
                            items: 3
                        },
                        992: {
                            items: 3
                        },
                        993: {
                            items: 4
                        }
                    }
                });
            });

            if ($('.list-actor .items', bodyTag).length) {
                $('.list-actor .items', bodyTag).css({
                    overflow: 'hidden'
                }).mCustomScrollbar({
                    scrollButtons: {
                        enable: true
                    },
                    theme: "light-thin"
                });
            }
			if ($('.list-group-trailer', bodyTag).length) {
                $('.list-group-trailer', bodyTag).css({
                    overflow: 'hidden'
                }).mCustomScrollbar({
                    scrollButtons: {
                        enable: true
                    },
                    theme: "light-thin"
                });
            }

            $('.rating-bar input', bodyTag).each(function() {
                var current_val_rating = $(this).val();
                var current_film_id = $(this).data('id');
                var current_this_rate = $(this);
                $(this).val((current_val_rating / 5).toFixed(1) * 5);
                $(this).rating({
                    showClear: false,
                    showCaptions: true,
                    hoverOnClear: false,
                    size: 'xs',
                    theme: 'krajee-fa',
                    min: 1,
                    max: 5,
                    step: 0.5,
                    filledStar: '<i class="fa fa-star"></i>',
                    emptyStar: '<i class="fa fa-star-o"></i>'
                }).on("rating.change", function(event, value, caption) {
                    var data_post = {
                        id: current_film_id,
                        value: parseInt(value)
                    };
                    $.ajax({
                        type: 'POST',
                        url: website_config.system.ajax_url + 'rate.php',
                        data: data_post,
                        dataType: 'json',
                        success: function(response) {
                            showAlert(response.message);
                            if (response.status == 'success') {
                                current_this_rate.rating('update', (response.data.rating_avg / 5).toFixed(1) * 5);
                            }
                        }
                    });
                });
            });


            $('.with-tabs .box-asian-tabs, .box-asian-tabs.tab-remote', bodyTag).each(function() {
                var _block_element, _block_content_element, $isBlock = true;
                if ($(this).hasClass('tab-remote')) {
                    $isBlock = false;
                }
                if ($isBlock) {
                    _block_element = $(this).parents('.block');
                    _block_content_element = $('>.block-content', _block_element);
                } else {
                    _block_element = $(this);
                    _block_content_element = $('>.tab-content', _block_element);
                }
                var nav_tabs = $(".nav-tabs", $(this));
                $('a', nav_tabs).on('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    $('li', nav_tabs).removeClass('active');
                    $(this).parent('li').addClass('active');
                    var _blockID = $(this).data('block');
                    var _currentElm = $('> .' + _blockID, _block_content_element);
                    if (!_currentElm.length) {
                        $('<div class="' + _blockID + ' hidden"></div>').appendTo(_block_content_element);
                        _currentElm = $('> .' + _blockID, _block_content_element);
                    }
                    if (_currentElm.length > 0) {
                        if ($.trim(_currentElm.html())) {
                            $('> div', _block_content_element).addClass('hidden');
                            _currentElm.removeClass('hidden');
                        } else {
                            _block_content_element.block(blockUiConfig);
                            $.ajax({
                                type: 'POST',
                                url: Base + 'ajax/widget.php',
                                data: {
                                    widget: 'list-film',
                                    type: _blockID
                                },
                                success: function(html) {
                                    $('> div', _block_content_element).addClass('hidden');
                                    _currentElm.html(html).removeClass('hidden').attr('id','owl-slide');
                                    _block_content_element.unblock();
									setupOwl('#'+_blockID+'',true);
                                },
                                error: function() {
                                    _block_content_element.unblock();
                                }
								
                            });
							
                        }
						
                    }
					
                    return false;
                });
            });
            $('.input-search', bodyTag).each(function() {
                var form_search = $(this).parents('.form-search');
                var search_options = {
                    width: form_search.width(),
					delay: 0 ,
                    maxHeight: 600,
                    deferRequestBy: 0,
                    type: 'POST',
                    serviceUrl: Base + 'search.php',
                    dataType: 'json',
                    formatResult: function(suggestion, currentValue) {
                        return suggestion.html;  
                  },
                    onSearchStart: function() {
                        $(".btn-search", form_search).html($("<i></i>").addClass("fa fa-spin fa-spinner"));
                    },
                    onSearchComplete: function() {
                        $(".btn-search", form_search).html('<i class="fa fa-search"></i>');
                    },
                    onSelect: function(suggestion) {
                        window.location.href = suggestion.data;
                    },
                    transformResult: function(response) {
                        return {
                            suggestions: $.map(response.suggestions, function(data) {
                                var templatePart = templatePartDefaultSearch;
                                templatePart = templatePart.split("__LINK__").join(data.link);
                                templatePart = templatePart.split("__NAME_ORIGINAL__").join(data.english + data.year);
                                templatePart = templatePart.split("__NAME__").join(data.vietnam);
                                templatePart = templatePart.split("__IMAGE__").join(data.image);
                                return {
                                    value: data.vietnam,
                                    html: templatePart,
                                    data: data.link
                                };
                            })
                        }
                    },
                    ajaxSettings: {
                        global: false
                    }
                };
                $(this).autocomplete(search_options);
            });


        },
        backToTop = function() {
            if ($('#back-to-top').length > 0) {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            }
        },
        loadBackToTop = function() {
            setTimeout(function() {
                if ($('#back-to-top').length < 1) {
                    bodyTag.append('<span id="back-to-top">&uarr;</span>');
                    backToTop();
                }
            }, 1000);
        },
        updateCssMedia = function() {
            if (window.matchMedia('(max-width: 860px)').matches) {
                if ($('.movie-info-detail').length < 1) {
                    var movie_info = $('.movie-info .page-col-right.pull-left', bodyTag).clone();
                    movie_info.removeAttr('class');
                    movie_info.addClass('movie-info-detail');
                    movie_info.appendTo($('.movie-info-top', bodyTag));
                }
            }
            if (window.matchMedia('(max-width: 991px)').matches) {
                bodyTag.addClass('max-width-992');
            } else {
                bodyTag.removeClass('max-width-992');
            }
        };

    $(window).on('scroll', function() {
        backToTop();
    });
    $(window).resize(function() {
        updateCssMedia();
    });
    $(document).ready(function() {
		var swiper = new Swiper('#slider', {
			pagination: '.swiper-pagination',
			paginationClickable: true,
			loop: true,
			autoplay: 4000,
		});
		UserAction('login_status');
		mySlidebars = new $.slidebars();
        updateCssMedia();
        afterAjaxLoad();
        $('.list-v').click();
        $('.top-day-ple').click();
        $('.top-day-pbo').click();
        $("#nav-menu-mobile > li > a").on("click", function(e) {
            if ($(this).parent().has("ul")) {
                e.preventDefault();
            }

            if (!$(this).hasClass("open")) {
                // hide any open menus and remove all other classes
                $("#nav-menu-mobile li ul").slideUp(350);
                $("#nav-menu-mobile li a").removeClass("open");

                // open our new menu and add the open class
                $(this).next("ul").slideDown(350);
                $(this).addClass("open");
            } else if ($(this).hasClass("open")) {
                $(this).removeClass("open");
                $(this).next("ul").slideUp(350);
            }
        });

        bodyTag.on('click', '.open-search', function(e) {
            e.stopPropagation();
            e.preventDefault();
            if ($(this).data('openSearch')) {
                $(this).data('openSearch', false);
                $('#mobile-header .form-search', bodyTag).hide();
                $(this).html('<i class="fa fa-search"></i>');
            } else {
                $(this).data('openSearch', true);
                $('#mobile-header .form-search', bodyTag).show().find('input').focus();
                $(this).html('<i class="fa fa-remove"></i>');
            }
            return false;
        }).on('click', '.movie-banner .icon-play.is-license', function(e) {
            e.preventDefault();
            showAlert('<p>Sorry! This content has been removed</p>');
            return false;
        }).on('click', '.movie-banner .icon-play.no-episode', function(e) {
            e.preventDefault();
            showAlert('<p>Sorry! This content has been removed</p>');
            return false;
        }).on('click', '.row-trailer a', function(e) {
            e.preventDefault();
            if ($('.trailer #youtube-frame').length > 0) {
                $('.trailer #youtube-frame').remove();
            }
            var html_embed_youtube = '<div id="youtube-frame"><span class="close"><i class="fa fa-remove"></i></span><iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + $(this).data('id') + '?rel=0&autoplay=1&modestbranding=1&autohide=1&showinfo=0&controls=0" scrolling="no" frameborder="0" allowfullscreen></iframe></div>';
            $('.trailer', bodyTag).append(html_embed_youtube);
            return false;
        }).on('click', '.row-trailer .trailer .close', function() {
            if ($('.trailer #youtube-frame').length > 0) {
                $('.trailer #youtube-frame').remove();
            }
        }).on('click', '#back-to-top', function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
            return false;
		}).on('click', '.change-server a[data-server-id]', function(a) {
			a.preventDefault();
			var i = $(this).parent('li');
			if (i.hasClass('active')) {
				return !1
			};
		})
    });

})(jQuery);
function setupOwl(ele,tworows){
	$(ele).owlCarousel({
			margin:10,
            loop: true,
            dots: false,
            nav: true,
			navText: ["",""],
			slideBy: 2,
			owl2row: tworows, // enable plugin
			owl2rowTarget: 'item',    // class for items in carousel div
			owl2rowContainer: 'owl2row-item', // class for items container
			owl2rowDirection: false, // ltr : directions
            responsive: {
				0: {
					items: 4
				},
				299: {
					items: 2
				},
				319: {
					items: 2
				},
				479: {
					items: 2
				},
				767: {
					items: 3
				},
				992: {
					items: 3
				},
				993: {
					items: 4
				},
				1050: {
                    items: 4
                },
				1150: {
                    items: 5
                },
                1250: {
                    items: 6
                },
				1440: {
                    items: 6
                }
			}
        });
}
$(document).ready(function() {
		setupOwl('#phim-rap',false);
		setupOwl('#phim-hoat-hinh',true);
		setupOwl('#phim-le',true);
		setupOwl('#phim-bo',true);		
		$('#moview-movie').css({
            opacity: 0,
            visibility: "visible"
        }).animate({
            opacity: 1.0
        }, 500);
    $("html").on("click", "#watch-now", function() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        loadServer(1,0);
        $('.player-wrapper').fadeIn();
		$('#watch-now').fadeOut();
    });
	$("html").on("click", "#lightBtn, #lightOff", function(e) {
		e.preventDefault();
        tatden();
    });
	$("html").on("click", "#download-image", function() {
        refreshCaptcha();
    });
    $(window).on("popstate", function(e) {
        if (e.originalEvent.state !== null) {
            window.location.href = location.pathname;
        }
    });
});
var isSeek = false;
function replace_embed(code) {
    var player_holder = $("#player-holder");
    var w = player_holder.width();
    var h = player_holder.height();
    return code.replace(/\(width\)/g, w).replace(/\(height\)/g, h);
}
function tatden() {
    $("html, body").animate({
        scrollTop: 0
    }).promise().done(function() {
        if ($(".sixteen-nine").hasClass("fixLightOff")) {
            $("#lightOff").fadeOut().promise().done(function() {
                $(".sixteen-nine").removeClass("fixLightOff");
            });
        } else {
            $(".sixteen-nine").addClass("fixLightOff");
            $("#lightOff").fadeIn();
        }
    });
}
function UserAction(act){
	if(act == 'login'){
		if($('#username').val() == '' || $('#password').val() == ''){
			$('#sign-in .login-error').show();
			$('#sign-in .login-error').html('<p>Nhập tên tài khoản và mật khẩu !</p>');
			var access = false;
		} else {
			var source = {
				username : $('#username').val(),
				pwd:$('#password').val(),
				act : 'login'
			}
			var access = true;
		}
	} else if (act == 'sign-out'){
		var access = true;
		var source = {
			act : 'sign-out'
		}
	} else if (act == 'login_status'){
		var access = true;
		var source = {
			act : 'login_status'
		}
	} else if (act == 'lostpass'){
		if($('#email').val() == ''){
			$('#sign-in .login-error').show();
			$('#sign-in .login-error').html('<p>Hãy nhập địa chỉ Email</p>');
			var access = false;
		} else {
			var source = {
				email : $('#email').val(),
				act : 'lostpass'
			}
			var access = true;
		}
	}
	if(access == true){
		$('#sign-in .login-error').show();
		$('#sign-in .login-error').html('<p>Đang xử lý dữ liệu ...</p>');
		$.ajax({
			type: "POST",
			url: Base + "ajax/user_login",
			data: source,
			dataType: 'json',
			success: function(res) {
				if(act == 'login'){
					if(res.stt == 'success'){
						UserAction('login_status');
						$('#sign-in').modal('hide');
						$('#sign-in .modal-body').html('');
					} else {
						$('#sign-in .login-error').show();
						$('#sign-in .login-error').html('<p>'+res.txt+'</p>');
					}	
				} else if (act == 'sign-out'){
					UserAction('login_status');
				} else if (act == 'login_status'){
					$('.user-acount').html(res.txt);
				} else if (act == 'lostpass'){
					if(res.stt == 'success'){
						UserAction('login_status');
						$('#sign-in').modal('hide');
						$('#sign-in .modal-body').html('');
						showAlert(res.txt);
					} else {
						$('#sign-in .login-error').show();
						$('#sign-in .login-error').html('<p>'+res.txt+'</p>');
					}	
				}	
			}
		});
	}
	return false;
}
function MakeSearch(){
	if(window.innerWidth <= 1000 && window.innerHeight <= 800) {
		var kw = $(".input-search.mobile").val();
	} else {
		var kw = $(".input-search.desktop").val();
	}
    kw = kw.toLowerCase();
    kw = kw.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    kw = kw.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    kw = kw.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    kw = kw.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    kw = kw.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    kw = kw.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    kw = kw.replace(/đ/g, "d");
    kw = kw.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, "-");
    kw = kw.replace(/-+-/g, "-"); //replace 2- to 1-
    kw = kw.replace(/^\-+|\-+$/g, ""); //remove - from first and last
    if (kw == '') alert("Vui lòng nhập từ khóa !");
    else location.href = Base + "search/" + kw + "/"
}
function setKeyStorage(key , value){
	localStorage.setItem(key, value);
}
function getKeyStorage(key){
	return localStorage.getItem(key);
}
function downloadFilm(film_id){
	$('#hidden-download').fadeOut('fast')
	$('#block-download').fadeIn('slow')
	$('html, body').animate({
		scrollTop: $("#block-download").offset().top
	}, 500);
}
function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
}
function setCookie(cname,cvalue,exdays) {
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}
function showForm(frm){
	if(frm == 'sign-in'){
		var html = 
		'<form onsubmit="return UserAction(\'login\');">'
		+'	<a href="https://www.facebook.com/dialog/oauth?client_id='+FBApp+'&redirect_uri='+Base+'ajax/connect.php?facebook=true&state='+FBState+'&scope=public_profile,email,manage_pages,publish_pages" class="btn btn-facebook btn-block btn-lg pv-lg"><i class="fa fa-facebook"></i> Đăng nhập Facebook</a>'
		+'	<div style="display:none" class="login-error alert alert-warning" role="alert"></div>'
		+'	<input type="text" id="username" class="form-control" placeholder="Tên tài khoản">'
		+'	<input type="password" id="password" class="form-control" placeholder="Mật khẩu">'
		+'	<input type="submit" class="btn btn-success submit_button"  value="Quẩy lên" name="submit">'
		+'	<a class="lost-pass" href="javascript:();" onclick="showForm(\'lost-pass\');"><strong>Quên mật khẩu ?</strong></a>'
		+'	<p class="modal-footer"></p>'
		+'</form>';
	} else if(frm == 'lost-pass'){
		var html = 
		'<form onsubmit="return UserAction(\'lostpass\');">'
		+'	<a href="https://www.facebook.com/dialog/oauth?client_id='+FBApp+'&redirect_uri='+Base+'ajax/connect.php?facebook=true&state='+FBState+'&scope=public_profile,email,manage_pages,publish_pages" class="btn btn-facebook btn-block btn-lg pv-lg"><i class="fa fa-facebook"></i> Đăng nhập Facebook</a>'
		+'	<div style="display:none" class="login-error alert alert-warning" role="alert"></div>'
		+'	<input type="text" id="email" class="form-control" placeholder="Tên tài khoản hoặc Email">'
		+'	<input type="submit" class="btn btn-success submit_button"  value="Quẩy lên" name="submit">'
		+'	<a class="lost-pass" href="javascript:();" onclick="showForm(\'sign-in\');">Đã có tài khoản ? <strong>Đăng nhập</strong></a>'
		+'	<p class="modal-footer"></p>'
		+'</form>';
	}
	
	$('#sign-in').modal('show');
	$('#sign-in .modal-body').html(html);
}
function ZoomToggle() {
    $("html, body").animate({
        scrollTop: 0
    }).promise().done(function() {
        if ($(".right-sidebar").hasClass("mt-lg")) {
            $("#pl-content").detach().appendTo('#normalPlayer');
            $(".right-sidebar").removeClass('mt-lg');
            $('.sixteen-nine').attr('style', 'height:450px');
            $('#zoomBtn').html('<i class="fa fa-arrows-h"></i> Phóng to');
        } else {
            $("#pl-content").detach().appendTo('#zoomPlayer');
            $(".right-sidebar").addClass('mt-lg');
            $('.sixteen-nine').attr('style', 'height:550px');
            $('#zoomBtn').html('<i class="fa fa-arrows-h"></i> Thu nhỏ');
        }
    });
}
function refreshCaptcha(){
	document.getElementById('download-image').src=Base+"modules/captcha.php?rnd=" + Math.random();
}
$.ajax({
    url: base_url + "ajax/load_login_status",
    type: "GET",
    dataType: "json",
    success: function(e) {
        $("#top-user").html(e.content), 1 == e.is_login && (is_login = !0)
    }
}), $("#request-form").submit(function(e) {
    var a = $(this).serializeArray(),
        t = $(this).attr("action");
    $.ajax({
        url: t,
        type: "POST",
        data: a,
        dataType: "json",
        success: function(e) {
            if ($(".error-block").hide(), 0 == e.status)
                for (var a in e.messages) $("#error-" + a).show(), $("#error-" + a).text(e.messages[a]);
            1 == e.status && ($("#message-success").show(), setTimeout(function() {
                $("#message-success").hide()
            }, 5e3), document.getElementById("request-form").reset())
        }
    }), e.preventDefault()
}); 
        function t(t) {
            return String(t).replace(/&/g, "").replace(/</g, "").replace(/>/g, "").replace(/"/g, "")
        }

        function i() {
            var i = $.trim($("#tukhoaiphim").val());
            "" != i && $.trim($("#tukhoaiphim").val()).length >= 1 ? (key = t(i), $(".autocomplete-suggestions").html(''), $(".autocomplete-suggestions").css("display", "block"), $.ajax({
                type: "POST",
                url: "http://xemlaco.net/search.php",
                data: "key=" + i,
                success: function(t) {
                    "" != t ? (t += '', $(".autocomplete-suggestions").html(t)) : $(".autocomplete-suggestions").html('<a href="https://iphimhd.com/search/' + key + '"><p>Không tìm thấy kết quả...</p></a>')
                }
            })) : ($(".autocomplete-suggestions").html(""), $(".autocomplete-suggestions").css("display", "none"))
        }
        var e = function() {
            var t = 0;
            return function(i, n) {
                clearTimeout(t), t = setTimeout(i, n)
            }
        }();
        $("#tukhoaiphim").keyup(function(t) {
            e(function() {
                i()
            }, 500), 13 == t.which && (value = $("#tukhoaiphim").val(), site_url = "http://xemlaco.net", link_search = site_url + "/search/" + value, window.location.replace(link_search))
        })
 