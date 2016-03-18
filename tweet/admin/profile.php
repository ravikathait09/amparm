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
if(empty($result) or $_POST['email']==$_SESSION['admin_info']['email'] )
{
	$_SESSION['admin_info']['email']=$_POST['email'];
	$user->id=$_SESSION['admin_info']['id'];
	$user->firstname = $_POST['first_name'];
	$user->lastname	 = $_POST['last_name'];
	$user->email	 = $_POST['email'];
	$user->phone	 = $_POST['phone'];
	$user->save();
	$_SESSION['msgsuccess'] = "User has been added successfully";                                
	redirectAdmin('userManagement.php');
	
}
else
{
$_SESSION['msgsuccess'] = "This Email id already EXists";                                
	//redirectAdmin('userManagement.php');
}
}
$userdetail=$user->findcustomrow(array('id'=>$_SESSION['admin_info']['id']));

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
												<input type="text" placeholder="Enter First Name" id="first_name" name="first_name" class="form-control required" value='<?php echo $userdetail['firstname'] ?>' required>
										  </div>

 <div class="form-group">
												<label for="exampleInputEmail1">Last Name</label>
												<input type="text" placeholder="Enter Last Name" id="last_name" name="last_name" class="form-control required" value='<?php echo $userdetail['lastname'] ?>' required>
										  </div>

 <div class="form-group">
												<label for="exampleInputEmail1">Email </label>
												<input type="text" placeholder="Enter Email" id="email" name="email" class="form-control required" value='<?php echo $userdetail['email'] ?>' required>
										  </div>
										  
 <div class="form-group">
												<label for="exampleInputEmail1">Phone </label>
												<input type="text" placeholder="Enter Phone" id="phone" name="phone" class="form-control required" value='<?php echo $userdetail['phone'] ?>' required>
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
