<?php
$clientId = '1013031085038-a5sc8qkf3m8td7qs1nov7sbl6kvt324g.apps.googleusercontent.com';
$clientSecret = 'hFfbNqSqEAbqDB3KOSuxp7EI';
$redirectUri = 'https://bongngo.net/gtoken.php';

require_once 'google-api-php-client/vendor/autoload.php'; // get from here https://github.com/google/google-api-php-client.git 

session_start();

$client = new Google_Client();
// Get your credentials from the console
$client->setApplicationName("Get Token");
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->setScopes(array('https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/devstorage.full_control'));
$client->setAccessType("offline");
$client->setApprovalPrompt('force');


if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();
	$client->getAccessToken(["refreshToken"]);
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    return;
}

if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['token']);
    $client->revokeToken();
}


?>

<!doctype html>
<html>
    <head><meta charset="utf-8"></head>
    <body>
        <header><h1>Token Generator</h1></header>
        <?php
        if ($client->getAccessToken()) {
            $_SESSION['token'] = $client->getAccessToken();
            $token = $_SESSION['token'];
            echo "Access Token = " . $token['access_token'] . '<br/>';
            echo "Refresh Token = " . $token['refresh_token'] . '<br/>';
           
			$saveToken = file_put_contents("token.txt",$token['refresh_token']); // Saving the refresh token in a text file. 
			if ($saveToken){
				echo 'Token saved successfully!<br/><br/>';
			}
			 echo "<a class='logout' href='?logout'>Logout</a>";
		} else {
            $authUrl = $client->createAuthUrl();
            print "<a class='login' href='$authUrl'>Connect Me!</a>";
        }
        ?>
    </body>
</html>

