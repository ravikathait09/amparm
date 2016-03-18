<?php
/**
*	THIS FILE IS FOR ADMIN LOGIN LOGOUT	5/4/2014
**/
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once('include/sidebar.php');
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}
  $user  = new Admin();


 //  $allLanguages = $language->getColumns();
if(isset($_POST['saveuser'])){
$result= $user->findcustomrow(array('email'=>$_POST['email']));
if(empty($result))
{
	$user->firstname = $_POST['first_name'];
	
	$user->email	 = $_POST['email'];
		$user->phone	 = $_POST['phone'];
	$password= $_POST['password'];
	$user->password=md5($password);
	$user->type=2;

	//$user->unique_code=time();
		$headers = 'From: Tweet Autotweet' . "\r\n".'reply-to: no-reply'. "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$msg.='<p> Hi '.	$user->firstname.'</p>';
		$msg.='<p> Your Account has been created your Login credential are as follow</p>';
		$msg.='<p>Email :'.$_POST['email'].'<br/> Password: '.$password.' </p>';
		$msg.='<p>Regards <br/> '.website_name.'</p>';
		mail( $_POST['email'], 'New User' , $msg,$headers );	
		$user->create();
	$_SESSION['msgsuccess'] = "User has been added successfully";                                
	redirectAdmin('userManagement.php');
	
}
else
{
$_SESSION['msgsuccess'] = "This Email id already EXists";                                
	//redirectAdmin('userManagement.php');
}
}

	//_d($allLanguages);
	?>
	            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
					<?php
		if(isset($_SESSION['msgsuccess'])){
			?>
			<div class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
				<b>Alert!</b> <?php echo $_SESSION['msgsuccess']; ?>.
			</div>
			<?php
			unset($_SESSION['msgsuccess']);
		}

		?>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="userManagement.php">Users Management</a></li>
                        <li class="active">Add User</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-9">
                            <!-- general form elements -->
                            <!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add User</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">first Name</label>
												<input type="text" placeholder="Enter First Name" id="first_name" name="first_name" class="form-control required" required>
										  </div>

										<div class="form-group">
											<label for="exampleInputEmail1">Email </label>
											<input type="text" placeholder="Enter Email" id="email" name="email" class="form-control required" required>
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Phone </label>
											<input type="text" placeholder="Enter Phone" id="phone" name="phone" class="form-control required" required>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Password </label>
											<input type="password" placeholder="Password" id="Password" name="password" class="form-control required" required>
										</div>

                                    <div class="box-footer">
                                        <button class="btn btn-primary" type="submit" name="saveuser">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                            
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>
