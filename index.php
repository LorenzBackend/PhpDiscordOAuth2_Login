<?php
error_reporting(-1);
ini_set('display_errors', 'on');

define('CONFIG_DIR', $_SERVER['DOCUMENT_ROOT'] .'/misc/config.php');

require_once $_SERVER['DOCUMENT_ROOT'] .'/misc/loader.php';

Router::GetRoute("/discord", "/core/apiHandler.php");
Router::GetRoute("/login", "/pages/login.php");
Router::GetRoute("/main", "/pages/main.php");
Router::GetRoute("/", "/pages/main.php");

Router::Init();












