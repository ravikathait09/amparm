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
   $settings = new Setting();
   $allSettings = $settings->all();

	//_d($allSettings);
	?>
	            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
				<div id= "success">	<?php
		if(isset($_SESSION['msgsuccess'])){
			?>
			<div class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
				<b>Alert!</b> <?php echo $_SESSION['msgsuccess']; ?>.
			</div>
			<?php
			unset($_SESSION['msgsuccess']);
		}

		?>
			</div>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        General Settings
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">General Settings</li>
                    </ol>
                </section>

                <!-- Main content -->                                                                             
                <section class="content">
                    <div class="row">
                        <!-- left column -->                     
                        <div class="col-md-12">                         
                            <!-- general form elements -->                         
                            <div class="box box-primary">                   
                               <!-- /.box-header -->                
                                <!-- form start -->
                                    <div class="box-body">                                                                                                           
										<table class="table table-bordered" id="userTable">             

                                        <thead><tr>
                                            <!-- <th style="width: 10px">#</th> -->
                                            <th>Name</th>
                                            <th>Value</th>
                                            <!-- <th style="width: 40px">Action</th>   -->                          
                                        </tr>                          
										</thead>                                 
										<tbody>                        
	<?php
   if(isset($allSettings) and is_array($allSettings) and count($allSettings)>0)                   
   {
	   foreach($allSettings as $k=>$allSettingsData){
		   ?>
                                        <tr>
                                            <!-- <td>1.</td> -->
                                            <td>
											<?php echo $allSettingsData['opt_title']; ?></td>
											
                                            <td>
											<?php if($allSettingsData['opt_title']!='Default Language') { 
												if($allSettingsData['opt_title']=='Payment Mode'){
												?>
											<a class="editVal form-control" data-type="select" data-pk="<?php echo $allSettingsData['id']; ?>"
											data-source="{'ON': 'ON', 'OFF': 'OFF'}"
											data-name="<?php echo $allSettingsData['opt_name']; ?>"
											data-table="setting"
											data-url="post.php?table=setting" data-original-title="<?php echo $allSettingsData['opt_title']; ?>">
                                                <?php echo $allSettingsData['opt_val']; ?>
												</a>
												<?php
											}
												elseif($allSettingsData['opt_title']=='Paypal Mode'){
												?>
											<a class="editVal form-control" data-type="select" data-pk="<?php echo $allSettingsData['id']; ?>"
											data-source="{'TEST': 'TEST', 'LIVE': 'LIVE'}"
											data-name="<?php echo $allSettingsData['opt_name']; ?>"
											data-table="setting"
											data-url="post.php?table=setting" data-original-title="<?php echo $allSettingsData['opt_title']; ?>">
                                                <?php echo $allSettingsData['opt_val']; ?>
												</a>
												<?php
											}
											else{
											?>
											<a class="editVal form-control" data-type="text" data-pk="<?php echo $allSettingsData['id']; ?>" data-name="<?php echo $allSettingsData['opt_name']; ?>"
											data-table="setting"
											data-url="post.php?table=setting" data-original-title="<?php echo $allSettingsData['opt_title']; ?>">
                                                <?php echo $allSettingsData['opt_val']; ?>
												</a>
											<?php }
											}
										
											else {?>
											
											<select name='defaultlang' onchange='changelanguage("<?php echo $allSettingsData['id'] ?>")' id='languagename'>
											 <?php foreach($allLanguages as $k=>$language){ ?>
											 <option value= "<?php echo $language['table_col_name'] ;?>" <?php if($language['table_col_name']==$allSettingsData['opt_val']) { ?>selected
											 <?php } ?>><?php echo $language['title'] ;?>
											 </option>
											 <?php } ?>
											</select>
											<?php
											}?>
                                            </td>
                                            <!-- <td><span class="badge bg-red">Edit</span></td> -->
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
<script>
function changelanguage(id){
	var lang=$('select#languagename option:selected').val();
		$.ajax({
		url: "../ajaxHandler.php?language="+lang+"&settingid="+id,
		
		success: function(msg){
			
			jQuery('#success').html(msg);
		  
		
		}


	})
}
</script>
