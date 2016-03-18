<?php

$fileBasePath = dirname(__FILE__).'/';                                              
include_once('include/header.php');
include_once('include/sidebar.php');                                   

if(!isset($_SESSION['admin_info'])){                              
	header('Location: logout.php');
}
   $contact  = new Contact();
  
  
   
   if(isset($_GET['delete'])){
	   $contact->delete($_GET['id']);
			$_SESSION['msgsuccess'] = "Contact has been deleted successfully";                                
			redirectAdmin('contact.php');
		
   }
    $contactlist = $contact->all();
  

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
                        Contacts Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Contact management</li>
                    </ol>
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
                                            <th>Name</th>
                                             <th>Email</th>
                                            <th>PHone</th>
                                         
                                           <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
<?php
					foreach($contactlist as $k=>$row){
						
						
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
							<td><?php echo $row['phone']; ?></td>
                                                       
						
							<td>
                                                            <a class="btn btn-primary" href="<?php echo $config['SITE_URL']."admin/viewcontact.php?id=".$row['id'] ;?>">View</a>
								&nbsp;&nbsp;
								
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/contact.php?delete=1&id=".$row['id'];?>">Delete</a>
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