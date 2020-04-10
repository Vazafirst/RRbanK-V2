<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require_once './fb/lib/Facebook/autoload.php';
$fb = new \Facebook\Facebook([
    'app_id' => '408520983269161',
    'app_secret' => '132e0e3f1924ad3a681630922294185e',
    'default_graph_version' => 'v5.0',
        //'default_access_token' => '{access-token}', // optional
        ]);

$helper = $fb->getRedirectLoginHelper();
// var_dump($helper);
$permissions = ['email'];

try {
    if (isset($_SESSION['face_access_token'])) {
        $accessToken = $_SESSION['face_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    $url_login = 'https://rrbank.cf/face.php';
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
} else {
    $url_login = 'https://rrbank.cf/face.php';
    $_SESSION['face_access_token'] = (string) $accessToken;
    $loginUrl = $helper->getLoginUrl($url_login, $permissions);
    //Usuário já autenticado
    if (isset($_SESSION['face_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['face_access_token']);
    }// Usuário não autenticado
    else {
        $_SESSION['face_access_token'] = (string) $accessToken;
        $oAuth2Client = $fb->getOAuth2Client();
        $_SESSION['face_access_token'] = $oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
        $fb->setDefaultAccessToken($_SESSION['face_access_token']);
    }

    try {
        // Returns a `Facebook\FacebookResponse` object
        $response = $fb->get('/me?fields=name, picture, email, id');
        $user = $response->getGraphUser();
      //  var_dump($user);
        $_SESSION['fbemail'] = $user['email'];
        $_SESSION['fbid'] = $user['id'];
        $_SESSION['fbname'] = $user['name'];
        include_once("./connection/connection.php");
        include_once './class/users.php';
        $objUser = new User();
        $objUser->fbidselect();
        /* $result_usuario = "SELECT id, nome, email FROM usuarios WHERE email='".$user['email']."' LIMIT 1";
          $resultado_usuario = mysqli_query($conn, $result_usuario);
          if($resultado_usuario){
          $row_usuario = mysqli_fetch_assoc($resultado_usuario);
          $_SESSION['id'] = $row_usuario['id'];
          $_SESSION['nome'] = $row_usuario['nome'];
          $_SESSION['email'] = $row_usuario['email'];
          header("Location: ./inicio.php"); */
    } catch (Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}
?>