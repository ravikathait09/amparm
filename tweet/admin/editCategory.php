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
$category = new Category();
$categoryurl=new CategoryUrl();
if(isset($_GET['catid']))
{
	$catid=$_GET['catid'];
}
if(isset($_POST['saveCatg'])){
	$category->id=$catid;
	$category->cat_name	 = $_POST['catName'];
	$category->cat_desc	 = $_POST['catDesc'];
	$category->save();
	   foreach($_POST['caturl']  as $key=>$value)
	   {   
	   $categoryurl=new CategoryUrl();
	   $categoryurl->catid=$catid;
			$categoryurl->url=$value;
			if($_POST['catid'][$key]){
				$categoryurl->id=$_POST['catid'][$key];
					$categoryurl->save();
			}else
			{
				$categoryurl->create();
			}
	   }   
   $_SESSION['msgsuccess'] = "Category has been added successfully";                                
   redirectAdmin('category.php');
}
$catdetail=$category->findcustomRow(array('id'=>$catid));
$caturl=$categoryurl->findcustom(array('catid'=>$catid));

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
                        <li><a href="category.php">Category Management</a></li>
                        <li class="active">Edit Category</li>
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
                                    <h3 class="box-title">Edit Category</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" name="" id="" method="post" action="">
                                    <div class="box-body">
										 <div class="form-group">
												<label for="exampleInputEmail1">Category Name</label>
												<input type="text" placeholder="Enter Category Name" id="catName" name="catName" class="form-control required" value="<?php echo $catdetail['cat_name'] ?>" required>
										  </div>
										 <div class="form-group">
												<label for="exampleInputEmail1">Category Description</label>
												<textarea type="text" placeholder="Enter Category Description" id="catDesc" name="catDesc" class="form-control required" required><?php echo $catdetail['cat_name'] ?></textarea>
										  </div>
                                        
									</div>
									<div id="test">
									<?php foreach($caturl as $key=>$value)
									{
										?>
										<div class="form-group" >
											<label for="exampleInputEmail1">Category Url</label>
											<input type="text" placeholder="Enter feed Url " id="caturl" name="caturl[]" class="form-control required" value="<?php echo $value['url'] ; ?>" >
											<input type="hidden"  id="catid" name="catid[]" class="form-control required" value="<?php echo $value['id'] ; ?>" >
											<div class="box-footer">
											<button class="btn btn-primary" type="button" onclick="remove_field_delte(this,'<?php echo $value['id'] ?>')" name="">Remove Url</button>
											</div>
										</div>
										
										<?php
									}
									?>
									</div>
									
									<div class="box-footer ">
                                        <button class="btn btn-primary" type="button" onclick="addurl('this')" name="saveCatg">Add Url</button>
                                    </div>
									

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
<div style="display:none" id='caturldiv'>
	<div class="form-group" >
		<label for="exampleInputEmail1">Category Url</label>
		<input type="text" placeholder="Enter feed Url " id="caturl" name="caturl[]" class="form-control required" >
		<div class="box-footer">
			 <button class="btn btn-primary" type="button" onclick="remove_field(this)" name="">Remove Url</button>
		</div>
	</div>
</div>
<script>
function addurl(obj)
{
	var html=$('#caturldiv').html();

	jQuery(html).appendTo('#test');
}
 function remove_field(obj) {
            var parent=jQuery(obj).parent().parent();
            //console.log(parent)
            parent.remove();
        }
function remove_field_delte(obj,id) {
            
			$.ajax({
				type:'post',
				url:'ajax.php',
				data:  {removeurl:id},
				success:function(res){	
					var parent=jQuery(obj).parent().parent();
					parent.remove();

				}
				}
				);
			
        }

</script>
