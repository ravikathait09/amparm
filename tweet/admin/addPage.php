<?php
/**
*	THIS FILE IS FOR ADMIN LOGIN LOGOUT	5/4/2014
**/
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once('include/sidebar.php');
include_once("../inc/twitteroauth.php");
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}

// Instantiate the user class
   $category = new Page();
 //  $allLanguages = $language->getColumns();
   if(isset($_POST['addpage'])){
	  // print_r($_POST['addpage']);
	   $category->title	 = $_POST['page_title'];
	  // $category->description	 = $_POST['description'];
	    $category->meta_tag	 = $_POST['meta_tag'];
	   $category->meta_keywords	 = $_POST['meta_keywords'];
	      $category->visibility	 = ISSET($_POST['visibility'])?"1":"0";
		  //_d($_POST);die();
	  $pageId = $category->create();
	   $_SESSION['msgsuccess'] = "Page has been added successfully";   
		redirectAdmin('managePageLang.php?pageId='.$category->lastInsertId());
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
                       Content Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="pages.php">Content Management</a></li>
                        <li class="active">Add Page</li>
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
                                    <h3 class="box-title">Add Page</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="saveCategory" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">Page title</label>
												<input type="text" placeholder="Enter Page title" id="catName" name="page_title" class="form-control required">
										  </div>
										
                   <div class='form-group' >
									<label for="exampleInputEmail1">Description</label>
                                         <textarea id="description" name="description" rows="10" cols="80"></textarea>                        
                                </div>
                        <div class="form-group">
												<label for="exampleInputEmail1">Meta keywords</label>
												<input type="text" placeholder="Enter Meta keywords" id="catName" name="meta_keywords" class="form-control required">
										  </div>

                            </div><!-- /.box -->
							 <div class="form-group">
												<label for="exampleInputEmail1">Meta tags</label>
												<input type="text" placeholder="Enter Meta tags" id="catName" name="meta_tag" class="form-control required">
										  </div>

                           
               
                                  <div class="form-group">
								  <label for="exampleInputEmail1">Visible</label>
                                        Yes<input type="radio" name="visibility" checked="checked" value="1">
                                        No<input type="radio" name="visibility"  value="0">
                                    </div      
								
<!-- /.box-body -->

                                    <div class="box-footer">
                                        <input class="btn btn-primary" type="submit" name="addpage" value="Add Page">
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

<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('description');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>