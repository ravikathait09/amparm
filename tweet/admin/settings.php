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
$settings = new Setting();
if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}
if(isset($_POST['saveuser'])){
	$settings->groupjoin = $_POST['groupjoin'];
	
	$settings->autotweet	 = $_POST['autotweet'];
	$settings->tweetafterschedule	 = $_POST['tweetafterschedule'];
	
	$settings->followerpoint=$_POST['followerpoint'];

	$settings->id = 1;
	$settings->unit= $_POST['unit'];
	$settings->save();
	$_SESSION['msgsuccess'] = "Setting been Updated successfully";                                
	redirectAdmin('settings.php');
	
}
   
   $allSettings = $settings->findcustomRow(array('id'=>1));

	
	?>
	            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
				<div id= "success">	<?php
		if(isset($_SESSION['msgsuccess'])){
			?>
			<div class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
				<b>Alert!</b> <?php echo $_SESSION['msgsuccess']; ?>.
			</div>
			<?php
			unset($_SESSION['msgsuccess']);
		}

		?>
			</div>
            
                <section class="content-header">
                    <h1>
                        General Settings
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">General Settings</li>
                    </ol>
                </section>

                <!-- Main content -->                                                                             
                <section class="content">
                    <div class="row">
                                         
                        <div class="col-md-12">                         
                                            
                            <div class="box box-primary">                   
                              
                                    <div class="box-body">    <form role="form" name="" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">Group Join Point</label>
												<input type="text" placeholder="Enter Group Join Point" id="first_name" name="groupjoin" class="form-control required" value="<?php echo $allSettings['groupjoin']; ?>" required>
										  </div>

										<div class="form-group">
											<label for="exampleInputEmail1">Autotweet Point </label>
											<input type="text" placeholder="Enter Autotweet" id="autotweet" name="autotweet" class="form-control required" value="<?php echo $allSettings['autotweet']; ?>" required>
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Tweet After Schedule Point </label>
											<input type="text" placeholder="Enter Tweet After Schedule" id="tweetafterschedule" name="tweetafterschedule" class="form-control required"   value="<?php echo $allSettings['tweetafterschedule']; ?>" required>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Unit </label>
											<input type="text" placeholder="Unit" id="unit" name="unit" value="<?php echo $allSettings['unit']; ?>" class="form-control required" required>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Follower Point </label>
											<input type="text" placeholder="Follower Point " id="followerpoint" name="followerpoint" class="form-control required" value="<?php echo $allSettings['followerpoint']; ?>" required>
										</div>

                                    <div class="box-footer">
                                        <button class="btn btn-primary" type="submit" name="saveuser">Submit</button>
                                    </div>
                                </form>                                                                                                         
										
                                    </div>
                            </div>
                    </div>  
                </section>
            </aside>
<?php
include_once('include/footer.php');

?>

