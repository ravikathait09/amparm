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
$main= new Main();
if(!isset($_SESSION['admin_info'])){                              
	header('Location: logout.php');
}
   $group  = new Group();
 
  
   if(isset($_GET['delete'])){
	   $group->delete($_GET['id']);
		$sql="delete from tweetuser where groupid='".$_GET['id']."'";
		$main->runsql($sql);
		$sql="delete from groupuser where groupid='".$_GET['id']."'";
		$main->runsql($sql);

		
   }
   if($_SESSION['admin_info']['type']==1){
		$allgroup = $group->getgroupbyowner();
   }
	else
	{
		$allgroup = $group->getgroupbyowner($_SESSION['admin_info']['id']);
	}

                                                            
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
                        Group Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Group management</li>
						 <li class=""><a href='addgroup.php'>Add Group</a></li>
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
                                            <th>Group Desc</th>
											<th>Group Url</th>
											<th>Group Admin</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
			<?php foreach($allgroup as $k=>$groupdata){ ?>
						
						<tr>
							<td><?php echo $groupdata['id']; ?></td>
							<td><?php echo $groupdata['title']; ?></td>
							<td><?php echo $groupdata['descripition']; ?></td>
							<td><?php echo $config['SITE_URL'].'?clean_url='.$groupdata['clean_url']; ?></td>
							<td><?php echo$groupdata['firstname'];  ?></td>
							<td>
								<a class="btn btn-primary" href="<?php echo $config['SITE_URL']."admin/editgroup.php?groupid=".$groupdata['id'];?>">Edit</a>
								&nbsp;&nbsp;
								<a class="btn btn-danger"  href="<?php echo $config['SITE_URL']."admin/userlist.php?TYPE=GROUP&id=".$groupdata['id'];?>">view Group Member</a>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/managegroup.php?delete=1&id=".$groupdata['id'];?>">Delete</a>
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
