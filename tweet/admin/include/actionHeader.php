<?php
ob_start();
session_start();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

$fileBasePath = dirname(__FILE__).'/../../include/';
include_once($fileBasePath.'config.php');
include_once($fileBasePath.'functions.php');

include_once($config['DOC_ROOT'].'classes/admin.class.php');
include_once($config['DOC_ROOT'].'classes/user.class.php');
include_once($config['DOC_ROOT'].'classes/tweet.class.php');
include_once($config['DOC_ROOT'].'classes/group.class.php');
include_once("../inc/twitteroauth.php");
?>
