<?php
include_once("login.php");
include_once("products.php");
include_once("db_connection.php");
include_once("functions.php");

$login2 = new login;
$products = new products;
$functions = new functions;


$login = "user";
$password = "password";

$loginverification = ($login2 -> loginVerification($login,$password));


?>