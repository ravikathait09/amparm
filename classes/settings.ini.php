<?php
$dir = dirname(__FILE__).'/../';
include_once($dir.'include/config.php');
global $config;
return array(
	'host'		=>	$config['DB_HOST'],                                                                               
	'user'		=>	$config['DB_USER'],                                                                                                        
	'password'	=>	$config['DB_PASSWORD'],                                                                                                             
	'dbname'	=>	$config['DB_NAME']                                                                                                                      
);
?>
