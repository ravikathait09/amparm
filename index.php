<?php
include_once('include/header.php');
$group= new Group();
$user=new User();
if(isset($_GET['clean_url']))
{
	 $result=$group->findCustomRow(array('clean_url'=>$_GET['clean_url']));
	 $_SESSION['GROUP']=$result;
	 $userresult=$user->findCustomRow(array('id'=>$result['owner_id']));
}
else if(isset($_SESSION['user_info'])){
	header('Location:dashboard.php');
}
if(isset($_POST['userid']) and isset($_POST['password'])){
	   $user  = new User();

	    $user->email = $_POST['userid'];
	    $user->password = md5($_POST['password']);
		$user->findCustom(Array('email'=>$user->email,'password'=>$user->password));
		echo '<pre>';
		print_R($user->variables);
		echo '</pre>';
		
		if(($user->variables[0]['type']==0) || ($user->variables[0]['type']==2)){
			$_SESSION['user_info'] = $user->variables[0];
			$_SESSION['msg'] = 18;
			$uri = 'dashboard';
			redirectAdmin($uri);
		}
		else{
			$_SESSION['msgerror'] = "Invalid login details";
			redirectAdmin('index');
		}

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
        <!-- End #header -->
        <!-- Start login container -->
		
		 <div class="container login-container">
            <div class="login-panel panel panel-default plain animated bounceIn">
                <!-- Start .panel -->
              
                <div class="panel-footer gray-lighter-bg">
                      <?php //if(isset($_SESSION['GROUP']['title'])){ ?>
					  <?php if(isset($_SESSION['GROUP']['title'])){ ?>
                      <p class="help-block"> You have been invited to join the  <?php echo  $_SESSION['GROUP']['title']; ?> group</p><br />
                    
					 <?php //} ?>
					   <?php if(!isset($_SESSION['GROUP']['title'])){ ?>
					  <h4>Please Login to check your account</h4>
					  <?php } ?>
					   <p class="text-center">
					  
					   <?php if(isset($_SESSION['GROUP']['title'])){ ?>
                     
                        <a href="process.php" class="btn btn-primary btn-alt mr10">Sign in with <i class="fa fa-twitter s20 ml5 mr0"></i></a> 
					   <p class="help-block"> This group will be used for sharing <?php echo  $_SESSION['GROUP']['title']; ?> update & useful information. </p><br />
					   <?php } else{ ?> 
                        <a href="process.php" class="btn btn-primary btn-alt mr10">Sign in with <i class="fa fa-twitter s20 ml5 mr0"></i></a> <?php } ?>
                      </p>
					  <?php } else{?>
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
					   <form class="form-horizontal mt0" action=""  method="post" id="login-form" role="form">
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Username:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="text" name="userid" id="userid" class="form-control required" value="" placeholder="Enter email">
                                    <span class="input-group-addon"><i class="icomoon-icon-user s16"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- col-md-12 start here -->
                                <label for="">Password:</label>
                            </div>
                            <!-- col-md-12 end here -->
                            <div class="col-lg-12">
                                <div class="input-group input-icon">
                                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="Your password">
                                    <span class="input-group-addon"><i class="icomoon-icon-lock s16"></i></span> 
                                </div>
                                <span class="help-block text-right"><a href="forgotPassword">Forgout password ?</a></span> 
                            </div>
                        </div>
                        <div class="form-group mb0">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <div class="checkbox-custom">
                                    <input type="checkbox" name="remember" id="remember" value="option">
                                    <label for="remember">Remember me ?</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25">
                                <button class="btn btn-default pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
					<div class="social-buttons text-center mt5 mb5">
                        <a href="process.php" class="btn btn-primary btn-alt mr10">Sign in with <i class="fa fa-twitter s20 ml5 mr0"></i></a> 
                       
                    </div>
					  
					  <?php } ?>
                </div>
                  
                </div>
            </div>
            <!-- End .panel -->
     



 <!-- End login container -->
        <div class="container">
            <div class="footer">
                <p class="text-center">&copy;2015 Copyright AMPARM All right reserved !!!</p>
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
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73919032-1', 'auto');
  ga('send', 'pageview');

</script>


    </body>
</html>