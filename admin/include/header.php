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
$notificaction = new Notification();
$allnotification=$notificaction->findCustom(array('userid'=>1,'status'=>0));
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AMPARM</title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               AMPARM Admin
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
					
                    <ul class="nav navbar-nav">
                       <li class="dropdown messages-menu open">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#"  aria-expanded="false" >
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo count($allnotification) ?></span>
            </a>
			  <?php if(!empty($allnotification)) { ?>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo count($allnotification) ?> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
				<?php  foreach($allnotification as $key =>$value){ $url='userManagement.php?grouppermission'; ?>
                   <li>
						<p><a href="<?php echo $url ; ?>">
							<i class="fa fa-users text-aqua"></i>
							<?php echo $value['notification'] ?>
						</a>
						</p>
                   </li>
				  <?php } ?>
                 
               
                
                </ul>
				</div>
              </li>
             
            </ul>
			  <?php } ?>
          </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                       AMPARM - Admin Area
                                        <small></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                      
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <!-- <a href="#">Sales</a> -->
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <!-- <a href="#">Friends</a> -->
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   <div class="pull-left">
                                        <a href="changePassword.php" class="btn btn-default btn-flat">Change Password</a>
                                    </div> 
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
		<div class="wrapper row-offcanvas row-offcanvas-left">
		
