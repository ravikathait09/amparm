<?php
/*
*	Admin Login Form
*/
include_once('include/guestHeader.php');
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(isset($_SESSION['admin_info'])){
	header('Location: index.php');
}
if(isset($_POST['userid']) and isset($_POST['password'])){
	   $user  = new User();

	    $user->email = $_POST['userid'];
	    $user->password = md5($_POST['password']);
		$user->findCustom(Array('email'=>$user->email,'password'=>$user->password));
		echo '<pre>';
		print_R($user->variables);
		echo '</pre>';
		
		if(($user->variables[0]['type']==1) || ($user->variables[0]['type']==2)){
			$_SESSION['admin_info'] = $user->variables[0];
			$_SESSION['msg'] = 18;
			$uri = 'userManagement.php';
			redirectAdmin($uri);
		}
		else{
			$_SESSION['msgerror'] = "Invalid login details";
			redirectAdmin('login.php');
		}

}
?>
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
	<div class="header">Sign In</div>
	<form action="" method="post" name="loginForm" id="loginForm" novalidate>
		<div class="body bg-gray">
			<div class="form-group">
				<input type="email" 
				
				name="userid" class="form-control required" placeholder="User ID"/>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control required" placeholder="Password"/>
			</div>          
		</div>
		<div class="footer">                                                               
			<button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
			
			<p><a href="forgotPassword.php">I forgot my password</a></p>                   
		</div>
	</form>
</div>
<?php
include_once('include/guestFooter.php');
?>