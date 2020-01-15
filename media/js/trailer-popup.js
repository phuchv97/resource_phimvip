var TrailerPopup=function(url,title,commentUrl){var _popupQueue=[];var _flagDisplay=false;var _url='';var _title='';var _commentUrl='';var _optionCode='';var _callback=null;var _p=this;var _getEmbedUrl=function(url,width){if(typeof width!="number"||width<0)
width=720;if(url.indexOf('youtube.com')!=-1)
{var reg=/v\=([^&]+)/;var result=reg.exec(url);if(result.length>0)
{var id=result[1];return 'https://www.youtube.com/embed/'+id+'?modestbranding=1&iv_load_policy=3&showinfo=1&rel=0&enablejsapi=1&origin='+window.location.protocol+'//'+window.location.host;}
return '';}
else if(url.indexOf('imdb.com')!=-1)
{var reg=/\/video\/imdb\/vi([0-9]+)/;var result=reg.exec(url);if(result.length>0)
{var id=result[1];return 'http://www.imdb.com/video/imdb/vi'+id+'/imdb/embed?autoplay=true&width='+width;}
return '';}
return '';}
var _getEmbedCode=function(url){var embedUrl=_getEmbedUrl(url);if(embedUrl!="")
return '<iframe id="trailer-player-inside" src="'+embedUrl+'" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no" style="border:0;margin:0;padding:0;width:100%;height:100%;"></iframe>';return '';}
var _initPopup=function(){if(jQuery('#overlay-popup-wrapper').length>0)
return false;var htmlContent='<div class="overlay-popup-bg" id="overlay-popup-bg" style="display:none"></div>\
			<div class="overlay-popup-wrapper" id="overlay-popup-wrapper" style="display:none;overflow: hidden;">\
			<div class="overlay-popup-header">\
				<span id="overlay-popup-title" class="header-text"></span>\
				<button id="overlay-popup-close" class="overlay-popup-close" title="Đóng cửa số này lại">×</button>\
			</div>\
			<div class="overlay-popup-body" style="height: 425px;">\
				<div id="trailer-player" style="width:720px;height:405px;display: inline-block;">\
					<iframe id="trailer-player-iframe" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no" style="border:0;margin:0;padding:0;width:100%;height:100%;"></iframe>\
				</div>\
				<div id="trailer-comment" style="display:inline-block;min-height:50px;width:400px;height:100%;overflow:auto;overflow-x: hidden;overflow-y: auto;float:right;background-color: rgba(0,0,0,0.85)">\
					<div id="trailer-comment-container" class="fb-comments" data-href="'+_commentUrl+'" data-width="400" data-numposts="10" data-order-by="reverse_time" data-colorscheme="dark" style="width:100%"></div>\
				</div>\
			</div>\
			</div>';jQuery('body').append(htmlContent);jQuery("#overlay-popup-close").click(function(){_p.closePopup();});}
this.setUrl=function(url){if(typeof url!="string")
return false;if(url.indexOf('youtube.com')==-1&&url.indexOf('imdb.com')==-1)
console.error('Hiện trailer chưa chấp nhận link: '+url);_url=url;return true;}
this.getUrl=function(){return _url;}
this.setTitle=function(title){if(typeof title=="string")
_title=title;}
this.getTitle=function(){return _title;}
this.setCommentUrl=function(url){if(typeof url=="string"&&url!="")
{_commentUrl=url;if(_commentUrl.indexOf('phimle.tv/')==-1)
_commentUrl="http://www.phimle.tv/"+_commentUrl;}}
this.getCommentUrl=function(){return _commentUrl;}
this.setOptionCode=function(code){if(typeof code=="string")
_optionCode=code;}
this.getOptionCode=function(){return _optionCode;}
this.setCallback=function(fn){if(typeof fn=="function")
_callback=fn;}
this.callCallback=function(){try{if(_callback!=null&&typeof _callback=="function")
_callback();}catch(err){}}
this.closePopup=function(){jQuery("#overlay-popup-bg,#overlay-popup-wrapper").fadeOut("fast",function(){if(typeof _flagDisplay!="undefined")
_flagDisplay=false;var ifrm=jQuery("#trailer-player-iframe")[0];ifrm=(ifrm.contentWindow)?ifrm.contentWindow:(ifrm.contentDocument.document)?ifrm.contentDocument.document:ifrm.contentDocument;ifrm.document.open();ifrm.document.write('');ifrm.document.close();if(_popupQueue.length>0)
{var popupObj=_popupQueue.shift();}});}
this.show=function(){if(_flagDisplay)
{_popupQueue.push({});return false;}
_initPopup();if(typeof _url=="string"&&_url!="")
this.load(_url,_title);var wW=jQuery(window).width();var wH=jQuery(window).height();var scrollWidth=18;var playerWidth=720;var commentWidth=400+scrollWidth;var innerWidth=playerWidth+commentWidth;var minOuterWidth=innerWidth+16+20;if(wW<1000)
{console.error("Kích thước cửa sổ quá nhỏ để mở popup");return false;}
else if(wW<minOuterWidth)
{innerWidth=wW-16-20;commentWidth=innerWidth-720;}
jQuery("#overlay-popup-wrapper").innerWidth(innerWidth+20);jQuery("#trailer-comment").width(commentWidth);jQuery("#trailer-comment-container").attr('data-width',commentWidth-scrollWidth);jQuery("#trailer-comment-container").css('margin-right',scrollWidth+'px');var oW=jQuery("#overlay-popup-wrapper").outerWidth();var oH=jQuery("#overlay-popup-wrapper").outerHeight();jQuery("#overlay-popup-wrapper").css({'left':'50%','top':'50%','margin-top':'-'+Math.ceil(oH/2)+'px','margin-left':'-'+Math.ceil(oW/2)+'px'})
try{if(jQuery("#trailer-comment-container").attr('fb-xfbml-state')!='rendered')
{if(typeof FB!="undefined"&&typeof FB.XFBML.parse=="function")
FB.XFBML.parse(jQuery("#trailer-comment")[0]);}}catch(err){console.error("Trailer Popup: "+err.message);}
_flagDisplay=true;this.callCallback();jQuery("#overlay-popup-bg,#overlay-popup-wrapper").fadeIn("fast");return true;}
this.load=function(trailerUrl,newTitle){this.setTitle(newTitle);if(!this.setUrl(trailerUrl))
return false;var embedCode=_getEmbedCode(_url);if(!embedCode)
return false;var optionCode=this.getOptionCode();var title=this.getTitle();var html='<!DOCTYPE html>\
			<html>\
			<title>Iframe '+title+'</title>\
			<head>\
				<style type="text/css" rel="stylesheet">\
				<!--\
				html,body\
				{\
					height: 100%;\
					width: 100%;\
				}\
				-->\
				</style>\
			</head>\
			<body style="margin:0;padding:0;overflow:hidden;">\
				<div id="trailer-wrapper" style="width:100%;height:100%;padding:0;margin:0;">\
				'+embedCode+'\
				</div>\
				'+optionCode+'\
			</body>\
			</html>';var ifrm=jQuery("#trailer-player-iframe")[0];ifrm=(ifrm.contentWindow)?ifrm.contentWindow:(ifrm.contentDocument.document)?ifrm.contentDocument.document:ifrm.contentDocument;ifrm.document.open();ifrm.document.write(html);ifrm.document.close();jQuery("#overlay-popup-title").html(title);return true;}
this.setUrl(url);this.setTitle(title);this.setCommentUrl(commentUrl);}