<?php
/*
*	Admin Login Form
*/
include_once('include/header.php');
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(isset($_SESSION['user_info'])){
	header('Location: index.php');
}
include_once($config['DOC_ROOT'].'classes/mailerClass.php');

if(isset($_POST['userid'])){
		$user  = new Admin();
	    $to=$user->email = $_POST['userid'];
		$user->findCustom(Array('email'=>$user->email));
		
		if(isset($user->variables[0]['id'])){
			$newPassword = generate_password();
			$userObj  = new Admin();
			$userObj->id		 = $user->variables[0]['id'];
			$userObj->password	 = md5($newPassword);
			$userObj->save();
			$headers = 'From: AMPARM' . "\r\n".'reply-to: no-reply'. "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		   
			$msg = "HI ".$user->variables[0]['firstname'].",<br/></br><p>Your New Password is <b>$newPassword</b>.</p><br/>";
			 $msg.='<p>Regards <br/> '.website_name.'</p>';
			 $_SESSION['msgerror'] = "Your password has been reset, Please check your mail.";
			mail($to,"Forget Password",$msg, $headers);
				redirectAdmin('index.php');
		}
		else{
			$_SESSION['msgerror'] = "Invalid Email Id";
			redirectAdmin('index.php');
		}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Lost password | Supr Admin Template</title>
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
        <!-- End #header -->
        <!-- Start login container -->
        <div class="container login-container">
            <div class="login-panel panel panel-default plain animated bounceIn">
                <!-- Start .panel -->
                <div class="panel-body">
					<div class="form-box" id="login-box">
					<?php
							if(isset($_SESSION['msgerror'])){                                    
								?>
								<div class="alert alert-danger alert-dismissable">                      
									<i class="fa fa-check"></i>
									<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
									<b>Alert!</b> <?php echo $_SESSION['msgerror']; ?>.                      
								</div>                    
								<?php
								unset($_SESSION['msgerror']);                     
							}
					?>
	<div class="header">Forgot Password</div>
	<form action="" method="post" name="loginForm" id="loginForm" novalidate>
		<div class="body bg-gray">
			<div class="form-group">
				<input type="email" 
				
				name="userid" class="form-control required" placeholder="User ID"/>
			</div>
         
		</div>
		<div class="footer">                                                               
			<button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
			
			<!-- <p><a href="#">I forgot my password</a></p> -->                    
		</div>
	</form>
 </div>
                <div class="panel-footer gray-lighter-bg">
                    <h4 class="text-center"><strong>Lost your password ?</strong>
                    </h4>
                    <p class="text-center">You will received new password in your email.</p>
                </div>
            </div>
            <!-- End .panel -->
        </div>
        <!-- End login container -->
        <div class="container">
            <div class="footer">
                <p class="text-center">&copy;2015 Copyright Supr.admin. All right reserved !!!</p>
            </div>
        </div>
        <!-- Javascripts -->
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
        window.jQuery || document.write('<script src="assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <!--[if lt IE 9]>
  <script type="text/javascript" src="js/libs/excanvas.min.js"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <script type="text/javascript" src="js/libs/respond.min.js"></script>
<![endif]-->
        <!-- Bootstrap plugins -->
        <script src="js/bootstrap/bootstrap.js"></script>
        <!-- Form plugins -->
        <script src="plugins/forms/validation/jquery.validate.js"></script>
        <script src="plugins/forms/validation/additional-methods.min.js"></script>
        <!-- Init plugins olny for this page -->
        <script src="js/pages/login.js"></script>
    </body>
</html>