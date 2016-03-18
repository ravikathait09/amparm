<?php
/**
*	ALL COMMON FUNCTIONS
*/

/*
*@access:	public
*@param:	Array
*@return:	Array in <pre> tag
*/
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
function getretweetdetail($tweetid)
{
	global $config;
	#include_once($config['DOC_ROOT'].'/inc/twitteroauth.php');
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	#print_R($connection);
	#echo $tweetid;
	$my_update = $connection->get('statuses/show', array('id' => $tweetid));
	return $my_update;
	#print_R($my_update);
}

function d($data){
	if(isset($data) and is_array($data) and count($data)>0){
		echo"<pre>";
		print_r($data);
		echo"</pre>";
	}
	else{
		echo"<b><i>Empty Array</i></b>";
	}
}


/*
*@access:	public
*@param:	String
*@return:	A Redirection
*/
function redirect($uri){
	header('Location:'. $config['SITE_URL'].$uri);
	exit;
}

/*
*@access:	public
*@param:	String
*@return:	A Redirection
*/
function redirectAdmin($uri){
	header('Location:'. $config['SITE_URL'].$uri);
	exit;
}
function generate_password()
{
	 $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
?>