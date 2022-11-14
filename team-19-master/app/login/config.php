<?php
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration
define('DB_HOST', 'db.sice.indiana.edu');
define('DB_USERNAME', 'i494f19_team19');
define('DB_PASSWORD', 'my+sql=i494f19_team19');
define('DB_NAME', 'i494f19_team19');
define('DB_USER_TBL', 'account');

// Google API configuration
define('GOOGLE_CLIENT_ID', '180412433479-q2631pagbiu6tscehtet5lf3ss333kgk.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', 'xyovdw-ZlaRjvqwOmjiepKxP');
define('GOOGLE_REDIRECT_URL', 'http://cgi.sice.indiana.edu/~team19/team-19/app/login/index.php');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to inviter');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
