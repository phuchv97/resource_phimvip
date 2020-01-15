<?php
$clientId = '1013031085038-a5sc8qkf3m8td7qs1nov7sbl6kvt324g.apps.googleusercontent.com';
$clientSecret = 'hFfbNqSqEAbqDB3KOSuxp7EI';
$redirectUri = 'https://bongngo.net/gtoken.php';
require_once 'google-api-php-client/vendor/autoload.php'; 

$driver = isset($_GET['url']) ? $_GET['url'] : '';
if(preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.*)\/view/U', $driver, $fileId)
		|| preg_match('/(.*):\/\/drive.google.com\/open\?id=(.+?)/U', $driver, $fileId)
		|| preg_match('/(.*):\/\/drive.google.com\/file\/d\/(.+?)/U', $driver, $fileId)){
$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$refreshToken = file_get_contents(__DIR__ . "/token.txt"); 
$client->refreshToken($refreshToken);
$tokens = $client->getAccessToken();
$client->setAccessToken($tokens);
$client->setDefer(true);
$url = 'https://www.googleapis.com/drive/v3/files/'.$fileId[2].'?alt=media&access_token='.$tokens['access_token'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$a = curl_exec($ch);
if(preg_match('#Location: (.*)#', $a, $r))
 $l = trim($r[1]);
echo '{"sources":[{"file":"'.$l.'","label":"720p","type":"video\/mp4"}]}';
}

