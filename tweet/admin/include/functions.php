<?php
/**
*	ALL COMMON FUNCTIONS
*/

/*
*@access:	public
*@param:	Array
*@return:	Array in <pre> tag
*/
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
function randompassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
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
?>