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
$main= new Main();
   $twiiter  = new twitter();
	$tweetergroup=new tweetergroup();
	if($_SESSION['admin_info']['type']==1){
		$alltweet = $twiiter->gettwiiterbyowner();
	}
	else
	{
		$alltweet = $twiiter->gettwiiterbyowner($_SESSION['admin_info']['id']);
	}
   //$alltweet= $twiiter->all();
 if(isset($_GET['delete'])){
	   $twiiter->delete($_GET['id']);
		$sql="delete from tweetuser where tweetid='".$_GET['id']."'";
		$main->runsql($sql);
		//$sql="delete from groupuser where groupid='".$_GET['id']."'";
		//$main->runsql($sql);

		
   }   
  $tweetuser= new Tweetuser;
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
                        Autotweet Management
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><a href="addautotweet.php">Add Tweet</a> </li>
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
                                            <th>Tweet Description</th>
											<th>Tweet Type</th>
                                            <th>Tweeter Group</th>
											<th>Date Time</th>
											<th>Owner</th>
											<th>Approve User</th>
											<!--<th>Status</th>-->
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
<?php
			$i=0;		foreach($alltweet as $k=>$tweetdata){ $i++;
						if($tweetdata['tweettype']==0) $type='Tweet' ; else $type='Retweet' ;
						$result=$tweetergroup->findgroupdetail($tweetdata['id']);
						
						$name='';
						foreach($result as $key=>$value){
							
							$name.=$value['title'].',';
						}
						
						$strname=substr($name,0,-1);
						$count=$tweetuser->countWhere('userid','status=1 and tweetid='.$tweetdata['id']);
?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $tweetdata['tweet']; ?></td>
							<td><?php echo $type; ?></td>
							<td><?php echo $strname; ?></td>
							<td><?php echo $tweetdata['datetime']; ?></td>
							<td><?php echo $tweetdata['firstname']; ?></td> 
							<td><?php echo $count; ?></td> 
							
							
							
						
							<td>
							
								<?php 
								
								?>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."admin/autotweet.php?delete=1&id=".$tweetdata['id'];?>">Delete</a>
								<a class="btn btn-danger"  href="<?php echo $config['SITE_URL']."admin/userlist.php?TYPE=TWEET&id=".$tweetdata['id'];?>">view ALL Member</a>
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
