<?php

require_once CONFIG_DIR;

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}


if (isset($_POST['action'])) {
  if ($_POST['action'] == 'login') {
    $params = array(
      'client_id' => OAUTH2_CLIENT_ID,
      'redirect_uri' => "https://your-online-webseite.com/discord", // discord is locatet to /core/apiHandler.php look in the index.php
      'response_type' => 'code',
      'scope' => 'identify guilds'
    );
    header('Location: https://discord.com/api/oauth2/authorize?' . http_build_query($params));
    die();  
  } 

  if ($_POST['action'] == "logout"){
    logout("https://discord.com/api/oauth2/token/revoke", array(
      'token' => $_SESSION['access_token'],
      'token_type_hint' => 'access_token',
      'client_id' => OAUTH2_CLIENT_ID,
      'client_secret' => OAUTH2_CLIENT_SECRET,
    ));
    unset($_SESSION['access_token']);
    session_destroy();
    header('Location: /login' );
    die();
  }  
}

if (isset($_GET['code'])) {
  try{
    $token = apiRequest('https://discord.com/api/oauth2/token', array(
      "grant_type" => "authorization_code",
      'client_id' => OAUTH2_CLIENT_ID,
      'client_secret' => OAUTH2_CLIENT_SECRET,
      'redirect_uri' => "https://your-online-webseite.com/discord", // discord is locatet to /core/apiHandler.php look in the index.php
      'code' => $_GET['code']
    ));
  
    $_SESSION['access_token'] = $token->access_token;
    $user = GetUser();
    if (count_chars($user->username) > 2){
      header('Location: /main' );
    }else{
      header('Location: /login' );
    }
 
  }catch (Exception $e){
    header('Location: /login' );
  
  }

}

function apiRequest($url, $post = NULL, $headers = array())
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);

  if ($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

  $headers[] = 'Accept: application/json';

  if (isset($_SESSION['access_token']))
    $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function logout($url, $data = array())
{
  $ch = curl_init($url);
  curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
    CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
    CURLOPT_POSTFIELDS => http_build_query($data),
  ));
  $response = curl_exec($ch);
  return json_decode($response);
}
