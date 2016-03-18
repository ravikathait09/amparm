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
if(isset($_POST['email']) and isset($_POST['password'])){
	
		$user  = new User();
		$result=$user->findCustom(array('email'=>$_POST['email']));
	
		if(empty($result)){
		$user->email = $_POST['email'];
		$user->firstname = $_POST['firstname'];
		$user->lastname = $_POST['lastname'];
		$user->phone = $_POST['phone'];
		$user->password = md5($_POST['password']);
		$userid =$user->create();
		$user->findCustomRow(Array('email'=>$user->email,'password'=>$user->password));
		$_SESSION['user_info'] = $user->variables;
		redirectAdmin('process.php');
		}
		else{
			$_SESSION['msgerror'] = "Email Already Exist";
			//redirectAdmin('process.php');
		}
echo 'adkfja';
die;
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
	<div class="header">Create Account</div>
	<form action="" method="post" name="loginForm" id="loginForm" novalidate>
		<div class="body bg-gray">
		
			<div class="form-group">
				<input type="text" name="firstname" class="form-control required" placeholder="First Name"/>
			</div>
			<div class="form-group">
				<input type="text" 
				
				name="lastname" class="form-control required" placeholder="last Name"/>
			</div>
			<div class="form-group">
				<input type="email" name="email" class="form-control required" placeholder="Email"/>
			</div>
			
			<div class="form-group">
				<input type="password" name="password" class="form-control required" placeholder="Password"/>
			</div>  
			
			
			
			<div class="form-group">
				<input type="text" name="phone" class="form-control required" placeholder="phone"/>
			</div> 
		</div>
		<div class="footer">                                                               
			<button type="submit" class="btn bg-olive btn-block">Register</button> 
			<a href='login.php'  class="btn bg-olive btn-block"> Login</a>
			
			<p><a href="forgotPassword.php">I forgot my password</a></p>                   
		</div>
	</form>
</div>
<?php
include_once('include/guestFooter.php');
?>