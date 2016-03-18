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
include_once($config['DOC_ROOT'].'classes/newsletter.class.php');
include_once($config['DOC_ROOT'].'classes/mailerClass.php');
include_once($config['DOC_ROOT'].'classes/subscriber.class.php');
include_once($config['DOC_ROOT'].'classes/mailTemplate.class.php');
include_once($config['DOC_ROOT'].'classes/messageTemplate.class.php');
if(isset($_POST['userid'])){
	   $user  = new Admin();

	    $user->email = $_POST['userid'];
		$user->findCustom(Array('email'=>$user->email));
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}
		//
		if(isset($user->variables[0]['id']) and $user->variables[0]['type']==1){
		$newPassword = generate_password();
		$userObj  = new Admin();
		$userObj->id		 = $user->variables[0]['id'];
		$userObj->password	 = md5($newPassword);
		$userObj->save();
	// Setup PHPMailer
	    $template = new mailTemplate();
    $templateOfInvoice = $template->findCustomRow(array('id'=>1));
	$invoiceStructure = $templateOfInvoice['description'];
	$emailMessageArr['URL_SITE'] = $config['SITE_URL'];
	$emailMessageArr['FORGOT_EMAIL_CONTENT'] = "HI ".$user->variables[0]['first_name'].",<br/></br><p>Your New Password is <b>$newPassword</b>.</p><br/>";
	$message = new MessageTemplate($invoiceStructure,$emailMessageArr);
	$decodedMsg = $message->toString();
	$message = $message;
	$mail = new PHPMailer();
	//$mail->IsSMTP();

	// This is the SMTP mail server
	//$mail->Host = 'mail.yourdomain.com';

	// Set who the email is coming from
	$mail->SetFrom('admin@komotor.com', 'Website Admin');

	// Set who the email is sending to
	$mail->AddAddress($user->variables[0]['email']);
	//$mail->AddAddress('er.amandeep04@gmail.com');

	// Set the subject
	$mail->Subject = $templateOfInvoice['subject'];

	//Set the message
	$mail->MsgHTML($decodedMsg);
	//$mail->AltBody(strip_tags($message));

	// Send the email
	if(!$mail->Send()) {
	 echo "Mailer Error: " . $mail->ErrorInfo;
	}
			$_SESSION['msg'] = 18;
			$uri = 'index.php';
			redirectAdmin($uri);
		}
		else{
			$_SESSION['msgerror'] = "Invalid Email Id";
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
<?php
include_once('include/guestFooter.php');
?>