<?php
define('RK_MEDIA',true);
require_once("phpfastcache.php");
$phpFastCache = phpFastCache();
require('init.php');
header("Content-type: text/xml");
	    global $phpFastCache;
	    $name = 'site-map';
        $data_cache = $phpFastCache->get($name);
		if($data_cache != null){
		    $xml = $data_cache; 
		} else {
#$file = CACHE_PATH.'xml/sitemap'.CACHE_EXT;
#$xml = Cache::BEGIN_CACHE($file);
if(!$xml) {
	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><?xml-stylesheet type=\"text/xsl\" href=\"/sitemap.xsl\"?>\n
			<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n
			<url>\n
				<loc>" . SITE_URL . "</loc>\n
				<changefreq>hourly</changefreq>\n
				<priority>1.00</priority>\n
				<lastmod>2019-08-02T00:03:12+07:00</lastmod>\n
			</url>\n
			<url>\n
				<loc>" . SITE_URL . "/tong-hop/phim-moi</loc>\n
				<changefreq>daily</changefreq>\n
				<priority>0.9</priority>\n
				<lastmod>2019-08-02T00:03:12+07:00</lastmod>\n
			</url>\n
			<url>\n
				<loc>" . SITE_URL . "/tong-hop/phim-le</loc>\n
				<changefreq>daily</changefreq>\n
				<priority>0.9</priority>\n
				<lastmod>2019-08-02T00:03:12+07:00</lastmod>\n
			</url>\n
			<url>\n
				<loc>" . SITE_URL . "/tong-hop/phim-bo</loc>\n
				<changefreq>daily</changefreq>\n
				<priority>0.9</priority>\n
				<lastmod>2019-08-02T00:03:12+07:00</lastmod>\n
			</url>\n
			<url>\n
				<loc>" . SITE_URL . "/tong-hop/phim-hot</loc>\n
				<changefreq>daily</changefreq>\n
				<priority>0.9</priority>\n
				<lastmod>2019-08-02T00:03:12+07:00</lastmod>\n
			</url>\n";
	$sitemap = MySql::dbselect("id,title,title_en,timeupdate,url", "film", "");
	$theloai = MySql::dbselect('id,name','category','id != 0');
	$quocgia = MySql::dbselect('id,name','country','id != 0');
		for ($i = 0; $i < count($theloai); $i++) {
			$title = $theloai[$i][1];
			$url_phim = Url::get(0,$title,'Thể loại');
			$lastmod = date('Y-m-d',time());
			if($i < 6) $priority[$i] = '0.9';
			elseif($i < 20) $priority[$i] = '0.8';
			elseif($i > 19) $priority[$i] = '0.6';
			$xml .= "<url>\n<loc>$url_phim</loc>\n<changefreq>daily</changefreq>\n<priority>".$priority[$i]."</priority>\n<lastmod>".$lastmod."T00:00:00+07:00</lastmod>\n</url>\n";
		}
		for ($i = 0; $i < count($quocgia); $i++) {
			$title = $quocgia[$i][1];
			$url_phim = Url::get(0,$title,'Quốc gia');
			$lastmod = date('Y-m-d',time());
			if($i < 6) $priority[$i] = '0.9';
			elseif($i < 20) $priority[$i] = '0.8';
			elseif($i > 19) $priority[$i] = '0.6';
			$xml .= "<url>\n<loc>$url_phim</loc>\n<changefreq>daily</changefreq>\n<priority>".$priority[$i]."</priority>\n<lastmod>".$lastmod."T00:00:00+07:00</lastmod>\n</url>\n";
		}
		for ($i = 0; $i < count($sitemap); $i++) {
			$title = $sitemap[$i][1];
			if (!$sitemap[$i][4]) {
						$url_phim = Url::get($sitemap[$i][0],$title,'Phim');
                        }
                        else {
						$url_phim = Url::get($sitemap[$i][0],$sitemap[$i][4],'Phim');
                           }
			$lastmod = date('Y-m-d',$sitemap[$i][3]);
			if(!$lastmod) $lastmod = '2019-08-02';
			if($i < 6) $priority[$i] = '0.9';
			elseif($i < 20) $priority[$i] = '0.8';
			elseif($i > 19) $priority[$i] = '0.6';
			$xml .= "<url>\n<loc>$url_phim</loc>\n<changefreq>daily</changefreq>\n<priority>".$priority[$i]."</priority>\n<lastmod>".$lastmod."T00:00:00+07:00</lastmod>\n</url>\n";
		}	
	$xml .= "</urlset>";
	#Cache::END_CACHE($xml,$file);
	if($xml != '') $phpFastCache->set($name, $xml, 2400);
      } 
}
echo $xml;
?>