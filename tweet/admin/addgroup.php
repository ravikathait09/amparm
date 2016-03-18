<?php
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once('include/sidebar.php');

if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}
$user=new User();
// Instantiate the user class
$Group = new Group();
$alluser= $user->selectalltype();
$groupuser=new groupuser();
//  $allLanguages = $language->getColumns();
if(isset($_POST['saveCatg'])){
   $result=$Group->findCustomRow(array('title'=>$_POST['title']));
   if(empty($result)){
	   $Group->title	 = $_POST['title'];
	   $Group->descripition	 = $_POST['desc'];
	   $Group->created=date('Y-m-d h:i:s');
	   $Group->clean_url=str_replace(' ','_',$_POST['title']);
	   $Group->owner_id=$_SESSION['admin_info']['id'];
	   $Group->create();
	   $lastid=   $Group->lastInsertId();
	   $groupuser=new groupuser();
	   $groupuser->groupid=$lastid;
	   $_SESSION['msgsuccess'] = "Group has been added successfully";     
		/*foreach($_POST['alluser'] as $key=>$value){
			$groupuser->userid=$value;
			$groupuser->create();
		}*/
			redirectAdmin('managegroup.php');
   }
   else{
		   $_SESSION['msgsuccess'] = "Group is already Exist";               
			redirectAdmin('addgroup.php');
   }
}

	?>   <!-- Right side column. Contains the navbar and content of the page -->
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
                        Group Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="Group.php">Group Management</a></li>
                        <li class="active">Add Group</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <!-- /.box-header -->
                                <!-- form start -->
                                    <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Add Group</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
								
                                <form role="form" name="" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">Group Name</label>
												<input type="text" placeholder="Enter Group Name" id="catName" name="title" class="form-control required" required>
										  </div>
										 <div class="form-group">
												<label for="exampleInputEmail1">Group Description</label>
												<textarea type="text" placeholder="Enter Group Description" id="catDesc" name="desc" class="form-control required" required></textarea>
										  </div>
                                     </div>
									 
									<!-- <div class="box-body">
											<div class="form-group">
												<label for="exampleInputEmail1">Select All</label>
												<input type="checkbox" placeholder="Enter Group Name" id="selectall"  class="form-control " >
											</div>
											 <?php foreach($alluser as $key=>$value) { ?>
												 <div class="form-group col-md-3">
														<label for="exampleInputEmail1"><?php echo $value['firstname']; ?></label>
														<input type="checkbox" placeholder="Enter Group Name" id="catName"  name='alluser[]' value='<?php echo $value['id']; ?>' class="form-control  selectall" >											
												  </div>										
											<?php } ?>
										
                                     </div>-->

                                    <div class="box-footer">
                                        <button class="btn btn-primary" type="submit" name="saveCatg">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                            
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php');

?>
