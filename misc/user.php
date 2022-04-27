<?php

require_once CONFIG_DIR;

function GetUser(){
    static $user;

    if ($user){
        return $user;
    }

    $user = apiRequest("https://discord.com/api/users/@me");
    return $user;
}

function GetUserName(){
    $user = GetUser();
    return $user->username;
}

function GetAvatar(){
    $user = GetUser();
   return "https://cdn.discordapp.com/avatars/" . $user->id . "/" . $user->avatar;
}

function LoggedIn() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
      }
      
      if (isset($_SESSION['access_token'])){
        $user = GetUser();
        if (count_chars($user->username) < 2) return false; 
        return true;
    }else{
        return false;
    } 
}