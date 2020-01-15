var Trailer=function(url){var _url='';this.setUrl=function(url){if(typeof url!="string")
return false;if(url.indexOf('youtube.com')==-1&&url.indexOf('imdb.com')==-1)
console.error('Hiện trailer chưa chấp nhận link: '+url);_url=url;}
this.getEmbedUrl=function(width){if(typeof width!="number"||width<0)
width=640;if(_url.indexOf('youtube.com')!=-1)
{var reg=/v\=([^&]+)/;var result=reg.exec(_url);if(result.length>0)
{var id=result[1];return 'https://www.youtube.com/embed/'+id+'?modestbranding=1&iv_load_policy=3&showinfo=1&rel=0&enablejsapi=1&origin='+window.location.protocol+'//'+window.location.host;}
return '';}
else if(_url.indexOf('imdb.com')!=-1)
{var reg=/\/video\/imdb\/vi([0-9]+)/;var result=reg.exec(_url);if(result.length>0)
{var id=result[1];return 'http://www.imdb.com/video/imdb/vi'+id+'/imdb/embed?autoplay=true&width='+width;}
return '';}
return '';}
this.setup=function(elementId,width,height){if(_url=="")
return false;if(typeof elementId!="string")
return false;if(jQuery("#"+elementId).length==0)
return false;var elem=jQuery("#"+elementId);if(typeof width!="number")
var width="100%";if(width=="100%")
width=jQuery(elem).width();if(typeof height!="number")
var height=Math.ceil(width/16*9);if(height=="100%")
height=jQuery(elem).height();var html='<iframe src="'+this.getEmbedUrl(width)+'" width="'+width+'" height="'+height+'" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no"></iframe>';jQuery(elem).html(html);return true;}
if(typeof url=="string")
this.setUrl(url);}
