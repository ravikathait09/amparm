<?php
$fileBasePath = dirname(__FILE__).'/';                                              
include_once('include/header.php');
include_once('include/sidebar.php');  

if(!isset($_SESSION['admin_info'])){                              
	header('Location: logout.php');
}
   $contact  = new Contact();
   if(isset($_GET['id'])){
       $id=$_GET['id'];
   $contactlist = $contact->findCustomRow(array('id'=>$id));
   }
   else
   {
       header('Location: contact.php');
   }
  ?>

	            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
				
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Contact Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="contact.php">Content Management</a></li>
                        <li class="active">View Contact</li>
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
                                    <h3 class="box-title">Edit Page</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="saveCategory" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1"> Name</label>
												<input type="text" value="<?php echo $contactlist['name']; ?>" id="catName" name="page_title" class="form-control required">
										  </div>
										
                   <div class='form-group'>
									<label for="exampleInputEmail1">Message</label>
                                        <textarea id="description" name="description" rows="10" cols="80"><?php echo $contactlist['message']; ?></textarea>                        
                                </div>
                        <div class="form-group">
												<label for="exampleInputEmail1">Email</label>
												<input type="text" value="<?php echo $contactlist['email']; ?>" id="catName" name="meta_keywords" class="form-control required">
										  </div>

                            </div><!-- /.box -->
							 <div class="form-group">
												<label for="exampleInputEmail1">Phone</label>
												<input type="text" value="<?php echo $contactlist['phone']; ?>" id="catName" name="meta_tag" class="form-control required">
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



<?php
include_once('include/footer.php');

?>
   
