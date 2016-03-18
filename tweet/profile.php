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
if(!isset($_SESSION['user_info'])){
	header('Location: logout.php');
}

// Instantiate the user class
   $user = new User();
 //  $allLanguages = $language->getColumns();
   if(isset($_POST['update'])){
		$user->id=$_SESSION['user_info']['id'];
		$user->firstname	 = $_POST['firstname'];
		$user->lastname	 = $_POST['lastname'];
		$user->phone	 = $_POST['phone'];
		$user->save();
		$_SESSION['user_info']['firstname']=$_POST['firstname'];
		$_SESSION['user_info']['lastname']=$_POST['lastname'];
		$_SESSION['user_info']['phone']=$_POST['phone'];
		$_SESSION['msgsuccess'] = "succesfully updated";   
		redirectAdmin('dashboard.php');
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
                      My Profile
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    
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
                                    <h3 class="box-title">Update</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="saveCategory" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">First Name</label>
												<input type="text" placeholder="First Name" id="catName" name="firstname" class="form-control required" value='<?php echo $_SESSION['user_info']['firstname'] ?>'>
										  </div>
										   <div class="form-group">
												<label for="exampleInputEmail1">Last Name</label>
												<input type="text" placeholder="Last Name" id="catName" name="lastname" class="form-control required" value='<?php echo $_SESSION['user_info']['lastname'] ?>'>
										  </div>
										
                   
										<div class="form-group">
												<label for="exampleInputEmail1">Phone</label>
												<input type="text" placeholder="Phone" id="catName" name="phone" class="form-control required" value='<?php echo $_SESSION['user_info']['phone'] ?>'>
										  </div>

									</div><!-- /.box -->
									<div class="box-footer">
                                        <input class="btn btn-primary" type="submit" name="update" value="Update Profile">
                                    </div>
                               </form>
                            </div><!-- /.box-body -->
                             </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>
<script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
