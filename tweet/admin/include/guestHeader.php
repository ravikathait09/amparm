<?php
ob_start();
session_start();

/**
*	THIS FILE IS FOR USER HEADER	3/10/2014
**/
$fileBasePath = dirname(__FILE__).'/../../include/';
include_once($fileBasePath.'config.php');
include_once($fileBasePath.'functions.php');
include_once($config['DOC_ROOT'].'classes/admin.class.php');
include_once($config['DOC_ROOT'].'classes/user.class.php');

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>                                                                                                                     
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $config['ADMIN_URL']; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $config['ADMIN_URL']; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $config['ADMIN_URL']; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
