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
    window.add_query_var = function(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    };
    window.show_loading_page = function(id) {
        if (loadedShowLoadingPage) {
            return;
        }
        var progressBar = $('#progress-content-ajax', bodyTag);
        progressBar.removeClass('done').css({
            width: '100%'
        });
        var _timeProgress = 0;
        if (!_setIntervalProgress) {
            _setIntervalProgress = setInterval(function() {
                _timeProgress += 10;
                if (_timeProgress >= 100) {
                    clearInterval(_setIntervalProgress);
                    _setIntervalProgress = 0;
                    progressBar.addClass('done').css({
                        width: '0%'
                    });
                }
            }, 50);
        }
        loadedShowLoadingPage = true;

        $('.ajax-overlay').removeClass('hidden');
        $('.ajax-loading-box').removeClass('hidden');
        $('[type="submit"]').each(function() {
            if (!$(this).attr('data-loading-text')) {
                $(this).attr('data-loading-text', 'Loading...');
            }
        });
        $('input[type="submit"][data-loading-text], button[type="submit"][data-loading-text]').each(function() {
            $(this).button('loading');
        });
        setTimeout(function() {
            hide_loading_page();
        }, 7000);
    };
    window.hide_loading_page = function(id, data) {
        if (!loadedShowLoadingPage) {
            return false;
        }

        loadedShowLoadingPage = false;
        $('.ajax-overlay').addClass('hidden');
        $('.ajax-loading-box').addClass('hidden');
        $('input[type="submit"][data-loading-text], button[type="submit"][data-loading-text]').each(function() {
            $(this).button('reset');
        });
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
                                url: base_url + 'ajax/get_content_box',
                                data: {
                                    key: _blockID
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
            var templatePartDefaultSearch = '<a class="clearfix" href="__LINK__"><div class="thumbnail"><img src="__IMAGE__" /></div><div class="meta-item"><div class="name-1">__NAME__</div><h4 class="name-2">__NAME_ORIGINAL__</h4></div></a>';
            $('.input-search', bodyTag).each(function() {
                var form_search = $(this).parents('.form-search');
                var search_options = {
                    width: form_search.width(),
					delay: 1000 ,
                    maxHeight: 500,
                    deferRequestBy: 1000,
                    type: 'POST',
                    serviceUrl: base_url + '/ajax/suggest_search',
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
		setupOwl('#new-video',true);		
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
function MakeSearch(){
	if(window.innerWidth <= 1000 && window.innerHeight <= 800) {
		var kw = $(".input-search.mobile").val();
	} else {
		var kw = $(".input-search.desktop").val();
	}
    kw = kw.toLowerCase();
    kw = kw.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, "-");
    // kw = kw.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
    // kw = kw.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
    // kw = kw.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
    // kw = kw.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
    // kw = kw.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
    // kw = kw.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
    // kw = kw.replace(/đ/g, 'd');
    kw = kw.replace(/-+-/g, "-"); //replace 2- to 1-
    kw = kw.replace(/^\-+|\-+$/g, ""); //remove - from first and last
    if (kw == '') alert("Vui lòng nhập từ khóa !");
    else location.href = base_url + "tim-kiem/" + kw + "/"
}
function utf8convert(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
    str = str.replace(/đ/g, 'd');
    // str = str.replace(/\W+/g, ' ');
    // str = str.replace(/\s/g, '-');
    return str;
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
var delayvpt = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

$('.tukhoaxlc').keyup(function() {
    delayvpt(function() {
        AutoComplete();
    }, 500);
});

function AutoComplete() {
    var keyword = $.trim($('.tukhoaxlc').val());
    if (keyword != "" && $.trim($('.tukhoaxlc').val()).length > 1) {
        $('.autocomplete-suggestions').html('<span id="loading"></span>');
        $('.autocomplete-suggestions').css('display', 'block');
        $.ajax({
                type: "POST",
                url: base_url +"ajax/suggest_search",
                data: "keysearch=" + keyword,
            success: function(message) {
                tukhoa = keyword.toLowerCase().replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a").replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e").replace(/ì|í|ị|ỉ|ĩ/g, "i").replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o").replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u").replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y").replace(/đ/g, "d").replace(/[éèêë]/g, "e").replace(/[îï]/g, "i").replace(/[ô]/g, "o").replace(/[ùû]/g, "u").replace(/[ñ]/g, "n").replace(/[äæ]/g, "ae").replace(/[öø]/g, "oe").replace(/[ü]/g, "ue").replace(/[ß]/g, "ss").replace(/[å]/g, "aa").replace(/[^-a-z0-9~\s\.:;+=_]/g, '').replace(/[\s\.:;=+]+/g, '+').replace(/-+-/g, "-").replace(/^\-+|\-+$/g, "");
                if (message != "") {
                    $('.autocomplete-suggestions').html(message);
                } else {
                    $('.autocomplete-suggestions').html('<a href="'+base_url +'/tim-kiem/' + tukhoa + '/" id="text-search-key">Nhấn Enter để tìm kiếm nâng cao</a>');
                }
            }
        });
    } else {
        $('.autocomplete-suggestions').html('');
    }
}
/* $.ajax({
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
}); */
jQuery("#btn-toggle-error").on("click", function() {
        jQuery.post("/ajax/error/", {
            film_id: filmInfo.filmID,
            episode_id: filmInfo.episodeID
        }, function(a) {
            1 == a && toastr.info("Thông báo của bạn đã được gửi đi, BQT sẽ khắc phục trong thời gian sớm nhất. Thank!")
        }), jQuery(this).remove()
    }),jQuery("#btn-add-favorite").on("click", function() {
         $.ajax({
            method: "POST",
            url: base_url + "ajax/user_favorite",
            data: {
            filmID: filmInfo.filmID
            },
            success: function(a) {
                                1 == a ? toastr.info("Lỗi", "Bạn cần đăng nhập để sử dụng chức năng này") : 2 == a ? toastr.info("Phim đã được xóa khỏi tủ phim của bạn.") : 3 == a && (jQuery(".btn-text").html("Xóa khỏi tủ phim"), toastr.info("Phim đã được thêm vào tủ phim của bạn."))
            }
        }), !1
});