<?php
/**
*	THIS FILE IS FOR ADMIN LOGIN LOGOUT	5/4/2014                                    
**/
$fileBasePath = dirname(__FILE__).'/';                                              
include_once('include/header.php');
include_once('include/sidebar.php');                                   

if(!isset($_SESSION['admin_info'])){                              
	header('Location: logout.php');
}
   $business  = new Bussiness();
   $businesslisting = $business->all();
  
   if(isset($_GET['block'])){
		if($admin->blockUser(array('id'=>$_GET['userId']),2)){
			$_SESSION['msgsuccess'] = "User has been blocked successfully";                                
			redirectAdmin('userManagement.php');
		}
   }
   if(isset($_GET['delete'])){
	   $admin->deleteUser($_GET['userId']);
			$_SESSION['msgsuccess'] = "User has been deleted successfully";                                
			redirectAdmin('userManagement.php');
		
   }
   if(isset($_GET['unblock'])){
		if($admin->blockUser(array('id'=>$_GET['userId']),1)){                                        
			$_SESSION['msgsuccess'] = "User has been unblocked successfully";
			redirectAdmin('userManagement.php');
		}                                           
   }
// Instantiate the user class
   $settings = new Setting();                              
   $allSettings = $settings->all(); 

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
                        Business Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Business management</li>
                    </ol>
                    <a class='btn btn-primary  pull-right' href='addBusiness.php'>Add Business</a>
                </section>

                <!-- Main content -->
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
										<table class="table table-bordered" id="userTable">
                                        <thead><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Title</th>
                                             <th>Price</th>
                                            <th>Address</th>
                                              <th>Area</th>
                                           <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
<?php
					foreach($businesslisting as $k=>$bussinessdetail){
						
						
						?>
						<tr>
							<td><?php echo $bussinessdetail['id']; ?></td>
							<td><?php echo $bussinessdetail['name']; ?></td>
                                                        <td><?php echo $bussinessdetail['price']; ?></td>
							<td><?php echo $bussinessdetail['address']; ?></td>
                                                        <td><?php echo $bussinessdetail['area']; ?></td> 
                                                 
							
						
							<td>
                                                            <a class="btn btn-primary" href="<?php echo $config['SITE_URL']."admin/editBusiness.php?bid=".$bussinessdetail['id'] ;?>">Edit</a>
								&nbsp;&nbsp;
								
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
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>