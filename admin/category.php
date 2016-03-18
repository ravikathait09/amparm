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
// Instantiate the user class
   $category = new Category();


   $allCategories = $category->all();

   if(isset($_GET['delid'])){
	   $category->id	 = $_GET['delid'];
	   $category->delete();
	   $_SESSION['msgsuccess'] = "Category has been deleted successfully";                                
	   redirectAdmin('category.php');
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
                        Category Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">General Settings</li>
                    </ol>
					<a class='btn btn-primary  pull-right' href="addCategory.php">Add Category</a>
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
                                            <th style="width: 10%">#</th>
                                            <th style="width: 60%">Name</th>
											 
                                           
                                            <th style="width: 30%">Action</th>
                                        </tr>

										</thead>
										<tbody>
										


	<?php
   if(isset($allCategories) and is_array($allCategories) and count($allCategories)>0)
   {
	   foreach($allCategories as $k=>$category){
		   ?>
                                        <tr>
                                            <td>1.
											</td>
                                            <td>
											<?php //_d($category); ?>
											<?php echo $category['cat_name']; ?></td>

											
                                           
                                            <td>
												
												<a href="?delid=<?php echo $category['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure');">Delete</a>
												<a href="editCategory.php?catid=<?php echo $category['id']; ?>" class="btn btn-danger" >Edit</a>
												<a href="viewfeed.php?catid=<?php echo $category['id']; ?>" class="btn btn-danger" >View Feed</a>
											</td>
                                        </tr>
		   <?php
	   }
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
