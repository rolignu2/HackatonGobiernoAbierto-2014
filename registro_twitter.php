<?php
require("twitter/twitteroauth.php");
require 'config/twconfig.php';
session_start();

$twitteroauth = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET);
$request_token = $twitteroauth->getRequestToken('http://localhost/ProyectoASP/getTwitterData.php');

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

if ($twitteroauth->http_code == 200) {
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: ' . $url);
} else {
    die('Something wrong happened.');
}
?>
