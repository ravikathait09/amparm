<?php
ob_start();
session_start();
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

$fileBasePath = dirname(__FILE__).'/';
include_once($fileBasePath.'config.php');
include_once($config['DOC_ROOT'].'include/functions.php');
include_once($config['DOC_ROOT'].'classes/admin.class.php');
include_once($config['DOC_ROOT'].'classes/user.class.php');
include_once($config['DOC_ROOT'].'classes/group.class.php');
include_once($config['DOC_ROOT'].'classes/tweet.class.php');
include_once($config['DOC_ROOT'].'/inc/twitteroauth.php');
/*function getretweetdetail($tweetid)
{
	global $config;
	#include_once($config['DOC_ROOT'].'/inc/twitteroauth.php');
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	#print_R($connection);
	#echo $tweetid;
	$my_update = $connection->get('statuses/show', array('id' => $tweetid));
	return $my_update;
	#print_R($my_update);
}*/
?>


