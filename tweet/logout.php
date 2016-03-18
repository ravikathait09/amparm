<?php
/**
*	USER LOGOUT PAGE
**/

$fileBasePath = dirname(__FILE__).'/';
include_once($fileBasePath.'include/header.php');
unset($_SESSION);
session_unset();
header('Location: index');
?>
