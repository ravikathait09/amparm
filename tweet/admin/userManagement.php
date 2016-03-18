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
if(!isset($_SESSION['admin_info']) ){                              
	header('Location: logout.php');
}
if( $_SESSION['admin_info']['type']!=1)
{
	header('Location: managegroup.php');
	
}
$notification = new Notification();
$main= new Main();
   $admin  = new User();
   
	if(isset($_GET['grouprequst']))
	{
	   $admin->id = $_GET['userId'];
	   $admin->manage_group = $_GET['grouprequst'];
	   $admin->save();
		if($_REQUEST['grouprequst']==1){
			$notification->notification="Your Group Request has been accepted";
			$notification->type='Group Request';
			$notification->userid=$_GET['userId'];
			$notification->eventid='';
			$notification->type='Group Request';
			$notification->create();
		}
		$_SESSION['msgsuccess'] = "Approval status has been updated successfully"; 
		if(isset($_REQUEST['grouppermission'])){
		redirectAdmin('userManagement.php?grouppermission');
		}else{
		redirectAdmin('userManagement.php');
		}
	}
   if(isset($_GET['approval'])){
	   $admin->id = $_GET['userId'];
	   $admin->approval_status = $_GET['approval'];
	   $admin->save();
		$_SESSION['msgsuccess'] = "Approval status has been updated successfully";         
		redirectAdmin('userManagement.php');
   }
   if(isset($_GET['block'])){
		if($admin->blockUser(array('id'=>$_GET['userId']),2)){
			$_SESSION['msgsuccess'] = "User has been blocked successfully";                                
			redirectAdmin('userManagement.php');
		}
   }
   if(isset($_GET['delete'])){
	   $admin->delete($_GET['userId']);
			$_SESSION['msgsuccess'] = "User has been deleted successfully";  
			$sql="delete from groupuser where userid='".$_GET['userId']."'";
			$main->runsql($sql);
			$sql="delete from tweetuser where userid='".$_GET['userId']."'";
			$main->runsql($sql);	
			redirectAdmin('userManagement.php');
		
   }
   if(isset($_GET['unblock'])){
		if($admin->blockUser(array('id'=>$_GET['userId']),1)){                                        
			$_SESSION['msgsuccess'] = "User has been unblocked successfully";
			redirectAdmin('userManagement.php');
		}                                           
   }
   $allUsers = $admin->findCustom(array('type'=>2));
   $tweetuser = $admin->findCustom(array('type'=>0));
if(isset($_GET['grouppermission'])){ 
$sql="select * from users where manage_group=2 or manage_group=3";
    $grouppermission= $main->runsql($sql);
#echo 'ravi';	
#print_R( $grouppermission);	
#die;
}


	//_d($allSettings);                                                                  
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
                        User Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">User Management</li>
						<li ><a href="addUser.php">Add User </a></li>
                    </ol>
                </section>
				<?php if(!isset($grouppermission)){ ?>
				 <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										Select User Type 
										 <input type='radio' name='usertype' value='' onclick='usertype("table2", "table1")' checked /> Twitter User
										 <input type='radio' name='usertype' value='' onclick='usertype("table1", "table2")'  /> Super User
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                <!-- Main content -->
                <section class="content"  id='table1' style='display:none'>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										<table class="table table-bordered" id="userTable2" >
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
											<th>Phone</th>
										
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
					<?php foreach($allUsers as $k=>$userData){
							
							 ?>

						<tr>
							<td><?php echo $userData['id']; ?></td>
							<td><?php echo $userData['firstname'] ?></td>
							<td><?php echo $userData['email']; ?></td>
							<td><?php echo $userData['phone']; ?></td> 
							
							<td>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?delete=1&userId=".$userData['id'];?>">Delete</a>
							</td>                                                                        
						</tr>                                                                                
						<?php
						
					}
					?>
                                    </tbody>
									</table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section ><!-- /.content -->
				  <section class="content" id='table2'  >
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										<table class="table table-bordered" id="userTable">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
											<th>Tweet</th>
											<th>Following</th>
											<th>Friend</th>
											<th>Favourite</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
						<?php foreach($tweetuser as $k=>$userData){ ?>
							
						

						<tr>
							<td><?php echo $userData['id']; ?></td>
							<td><?php echo $userData['firstname'] ?></td>
							<td><?php echo $userData['email']; ?></td>
							<td><?php echo $userData['tweetcount']; ?></td> 
							<td><?php echo $userData['friendcount']; ?></td> 
							<td><?php echo $userData['follower']; ?></td>
							<td><?php echo $userData['favourite']; ?></td> 
							
							<td>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?delete=1&userId=".$userData['id'];?>">Delete</a>
								<?php if($userData['manage_group']==1 ){ ?>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?grouprequst=3&userId=".$userData['id'];?>">Cancel Group Permission</a>
								<?php } else if($userData['manage_group']==2 || $userData['manage_group']==3 ){?>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?grouprequst=1&userId=".$userData['id'];?>">Approve Group Request</a>
								<?php } ?>
							</td>                                                                        
						</tr>                                                                                
						<?php
						
					}
					?>
                                    </tbody>
									</table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
				<?php } else { ?>
				<section class="content" id='table2'  >
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box-body">
										<table class="table table-bordered" id="userTable2">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
											<th>Tweet</th>
											<th>Following</th>
											<th>Friend</th>
											<th>Favourite</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
						<?php foreach($grouppermission as $k=>$userData){ ?>
							
						

						<tr>
							<td><?php echo $userData['id']; ?></td>
							<td><?php echo $userData['firstname'] ?></td>
							<td><?php echo $userData['email']; ?></td>
							<td><?php echo $userData['tweetcount']; ?></td> 
							<td><?php echo $userData['friendcount']; ?></td> 
							<td><?php echo $userData['follower']; ?></td>
							<td><?php echo $userData['favourite']; ?></td> 
							
							<td>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?delete=1&userId=".$userData['id'];?>">Delete</a>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?grouppermission&grouprequst=1&userId=".$userData['id'];?>">Approve Group Request</a>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/userManagement.php?grouppermission&grouprequst=3&userId=".$userData['id'];?>">Cancel Group Request</a>
							</td>                                                                        
						</tr>                                                                                
						<?php
						
					}
					?>
                                    </tbody>
									</table>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

				<?php } ?>
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>
<script>
changenotificationstatus();
function usertype(id1, id2)
{
	$('#'+id1).show();
	$('#'+id2).hide();
}

</script>

