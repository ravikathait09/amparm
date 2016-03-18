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
$userObj = new User;
if(isset($_POST['newPass'])){
	if($_SESSION['admin_info'][0]['password']==md5($_POST['currentPass'])){
		$userObj->id		 = $_SESSION['admin_info'][0]['id'];
		$userObj->password	 = md5($_POST['newPass']);
		$userObj->save();
		$_SESSION['admin_info'][0]['password'] = md5($_POST['newPass']);
		$_SESSION['msgsuccess'] = "Password changed successfully";
		header('Location: changePassword.php');
	}
	else{
		$_SESSION['msgerror'] = "Enter valid current password";
		header('Location: changePassword.php');
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
                      Change Password
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="changePassword.php">Change Password</a></li>
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
                                    <h3 class="box-title">Change Password</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                				<form method="post" action="" name="chgPassForm" id="chgPassForm">
					<table class="table">
						<tr >
						<td><label class="control-label col-lg-6"><?php echo "Current Password"; ?></label></td>
							<td>
								<input class="required form-control" type="password" placeholder="" id="currentPass" name="currentPass">
							</td>
						</tr>
						<tr >
							<td><label class="control-label col-lg-6"><?php echo "New Password"; ?></label></td><td>
								<input class="required form-control" type="password" placeholder="" id="newPass" name="newPass">
							</td>
						</tr>
						<tr >
							<td><label class="control-label col-lg-6"><?php echo "Confirm Password"; ?></label></td><td>
								<input class="required form-control" type="password" placeholder="" id="newConfirmPass" name="newConfirmPass">
							</td>
						</tr>
							<tr >
								<td></td><td>
									<input type="submit" class="btn btn-success btn-large" name="updateBtn" id="updateBtn" value="Update">
								</td>
							</tr>
					</table>
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
<script>
$("#chgPassForm").validate({
		rules : {
                newPass : {
                    minlength : 5
                },
                newConfirmPass : {
                    minlength : 5,
                    equalTo : "#newPass"
                }
		},
		highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	});
</script>
