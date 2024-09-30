<?php
session_start();

$_SESSION['id']='';
$_SESSION['username']='';
$_SESSION['password']='';
$_SESSION['name']='';
$_SESSION['level']='';

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['name']);
unset($_SESSION['level']);

session_unset();
session_destroy();
header('Location:login.php');

?>
