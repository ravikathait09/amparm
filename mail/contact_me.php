<?php
include('../tweet/include/actionHeader.php');
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
$contactobj=new Contact();
$contactobj->name=$name = $_POST['name'];
$contactobj->email=$email_address = $_POST['email'];
$contactobj->phone=$phone = $_POST['phone'];
$contactobj->msg=$message = $_POST['message'];
$contactobj->created=date('y-m-d h:i:s');
$contactobj->create();	
// Create the email and send the message
$to = 'ravinder.singh@armdigital.in;honey@armdigital.in;';
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@amparm.com\n"; 
$headers .= "Reply-To: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>