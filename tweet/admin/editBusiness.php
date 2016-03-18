<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once('include/sidebar.php');

if(!isset($_SESSION['admin_info'])){
	header('Location: logout.php');
}


 $business  = new Bussiness();
$gallery=new Gallery();
if(isset($_GET['bid']))
{
    $bid=  $_GET['bid'];
    $businessdetail  = $business->findCustomRow(array('id'=>$bid));
    $galleries=$gallery->findCustom(array('bussinessid'=>$bid));
}
else
{
    header('location : addBusiness.php');
}
if(isset($_POST['editbussiness'])){
$gallery=new Gallery();
	$business->name = $_POST['title'];
        $business->id=$bid; 
	$business->description	 = $_POST['description'];
	$business->contactemail	 = $_POST['email'];
	$business->address	 = $_POST['address'];
	$business->contactphone	 = $_POST['phone'];
        $business->price	 = $_POST['price'];
        $business->zip	 = $_POST['zip'];
        $business->area	 = $_POST['region'];
	
	$business->save();
   
      $uploadurl=$config['DOC_ROOT'].'upload/';
     if(isset($_FILES['upload']) && !empty($_FILES['upload']))
     {
         foreach($_FILES['upload']['name'] as $key =>$value)
         {
             $filename=time().$_FILES['upload']['name'][$key];
            if(move_uploaded_file($_FILES['upload']['tmp_name'][$key],$uploadurl.$filename)){
                $gallery->bussinessid=$bid;
                $gallery->imageurl=$filename;
                $gallery->create();
            }
             
         }
     }


$_SESSION['msgsuccess'] = "This Email id already EXists";                                
	//redirectAdmin('userManagement.php');

}

	//_d($allLanguages);
	?>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
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
                      Add  Business 
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="bussinessManagement.php.php">Users Business</a></li>
                        <li class="active">Add Business</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
                    <form role="form" name="" id="" method="post" action="" enctype="multipart/form-data">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                           
                                    <div class="box box-primary">
                             
                            
                                    <div class="box-body">
                                        <div class="form-group">
                                                       <label for="exampleInputEmail1">Business Title</label>
                                                       <input type="text" placeholder="Enter Title" id="title" name="title" class="form-control required" value='<?php echo $businessdetail['name'] ?>' required>
                                         </div>

                                        <div class="form-group">
                                                       <label for="exampleInputEmail1"> Description</label>
                                                        <textarea id="description" name="description" rows="10" cols="80"><?php echo $businessdetail['description'] ?></textarea>                        
                                         </div>

                                     
                            </div><!-- /.box-body -->
                          
                    </div>   <!-- /.row -->
                        </div>
                         <div class="col-md-6">
                           
                                    <div class="box box-primary">
                             
                            
                                    <div class="box-body">
                                      
                                        <div class="form-group">
                                                       <label for="exampleInputEmail1">Price </label>
                                                       <input type="text" placeholder="Enter Price" id="price" name="price" class="form-control required" value='<?php echo $businessdetail['price'] ?>'  required>
                                         </div>

                                        <div class="form-group">
                                                       <label for="exampleInputEmail1">Address</label>
                                                       <Textarea type="text" placeholder="Enter Address" id="address" name="address" class="form-control required"   required><?php echo $businessdetail['address'] ?></textarea>
                                         </div>
                                         <div class="form-group">
                                                       <label for="exampleInputEmail1">Zip</label>
                                                       <input type="text" placeholder="Enter Zip" id="zip" name="zip" class="form-control required" value='<?php echo $businessdetail['zip'] ?>' required>
                                         </div>

                                        <div class="form-group">
                                                       <label for="exampleInputEmail1">Contact Email</label>
                                                       <input type="email" placeholder="Email" id="region" name="email" class="form-control required" value='<?php echo $businessdetail['contactemail'] ?>' required>
                                         </div>
                                        
                                          <div class="form-group">
                                                       <label for="exampleInputEmail1">Contact Phone</label>
                                                       <input type="digit" placeholder="PHone" id="phone" name="phone" class="form-control required" value='<?php echo $businessdetail['contactphone'] ?>' required>
                                         </div>
                                          <div class="form-group">
                                                       <label for="exampleInputEmail1"> Region</label>
                                                       <input type="digit" placeholder="Region" id="phone" name="region" class="form-control required" value='<?php echo $businessdetail['area'] ?>' required>
                                         </div>
                                       								

                                   
                               
                            </div><!-- /.box-body -->
                          
                    </div>   <!-- /.row -->
                        </div>
                         <div class="col-md-12">
                             <div class="box box-primary">
                               <div class="box-body">
                                      <div class="box-footer" style='padding-left: 50%'>
                                        <input  type='file' class="btn btn-primary" onchange='vpb_image_preview(this)'  name="upload[]"multiple>
                                    </div>
                                 </div>
                                   <div class="box-body"  style="width:710px; margin-left:15%; margin-right:15%">
                                       <div style="width:710px; margin-top:50px;" align="center" id="vpb-display-preview2">
                                          <?php  foreach($galleries as $key =>$value){ ?>
                                           <div id="selector_<?php echo $value['id'] ?>" class="vpb_wrapper">
                                               <img class="vpb_image_style" src="<?php echo $config['SITE_URL'].'upload/'.$value['imageurl'] ?>"><br>
                                               <a style="cursor:pointer;padding-top:5px;" title="Click here to remove" onclick="vpb_remove_uploaded2('<?php echo $value['id'] ?>','<?php echo $value['imageurl'] ?>')">Remove</a> 
                                           </div>
                                          <?php } ?>
                                           
                                       </div>
                                        <div style="width:710px; margin-top:50px;" align="center" id="vpb-display-preview"></div>
                                   </div>
                                 <div class="box-body">
                                      <div class="box-footer" style='padding-left: 50%'>
                                        <button class="btn btn-primary" type="submit" name="editbussiness">Submit</button>
                                    </div>
                                 </div>
                             </div>
                         </div>
                           
                    </div>
                              </form>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include_once('include/footer.php'); ?>
        
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
          