<?php
/*
*	Config Array stores project's config data
*/
$config = array();
date_default_timezone_set("Asia/Kolkata");
define('website_name','AMPARM');
$config['DB_HOST'] = 'localhost';
$config['DB_USER'] = 'amparm';
$config['DB_PASSWORD'] = 'foobarbaz';
$config['DB_NAME'] = 'amparm';
$config['SITE_HOST'] = $_SERVER['HTTP_HOST'];
$config['PROJECT_NAME'] = 'tweet';
$config['SITE_URL'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$config['PROJECT_NAME'].'/';
$config['DOC_ROOT'] = $_SERVER['DOCUMENT_ROOT'].$config['PROJECT_NAME'].'/';
$config['ADMIN_DOCROOT'] = $_SERVER['DOCUMENT_ROOT'].'/'.$config['PROJECT_NAME'].'/admin/';
$config['ADMIN_URL'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$config['PROJECT_NAME'].'/admin/';
$URL_SITE = $config['SITE_URL'];

define('CONSUMER_KEY', 'kn2acChawNBUispfaFUHrnI5N');
define('CONSUMER_SECRET', 'UBtN1QuaoHgwezQd7paQW2UWlkkM5Ok9N2pJ0gaadHMj16d9Q5');
define('OAUTH_CALLBACK', $config['SITE_URL'].'process.php');

?>
