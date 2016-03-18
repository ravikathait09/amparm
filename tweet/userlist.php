<?php
/**
*	THIS FILE IS FOR ADMIN LOGIN LOGOUT	5/4/2014                                    
**/
$fileBasePath = dirname(__FILE__).'/';                                              
include_once('include/header.php');                             
/*
*	Redirect Admin To Home Page
*	If Already Logged In
*/
if(!isset($_SESSION['user_info'])){                              
	header('Location: logout');
}
if($_SESSION['user_info']['manage_group']!=1){
	header('location:dashboard');
}
  $main=new main();
    if(isset($_GET['delete'])){
			$userid=$_GET['userId'];
			$id=$_GET['id'];
				if($_GET['TYPE']=='GROUP')
				{
					$sql="delete from tweetuser where groupid='".$id."' and  userid='".$userid."'";
					$main->runsql($sql);
					$sql="delete from groupuser where groupid='".$id."' and  userid='".$userid."'";
					$main->runsql($sql);
				}
				else{
					$sql="delete from tweetuser where tweetid='".$id."' and  userid='".$userid."'";
					$main->runsql($sql);
				}
					$_SESSION['msgsuccess'] = "User has been Removed successfully";  
			//redirectAdmin('userManagement.php');
		
   }
   $allUsers =array();
   if(isset($_GET['TYPE']) && isset($_GET['id']) && !empty($_GET['id']) && !empty($_GET['TYPE']))
   {
	    if($_GET['TYPE']=='GROUP')
		{
			$groupuser=new groupuser();
			$allUsers =$groupuser->findgroupuser($_GET['id']);
		}
		else{
			$tweetuser=new Tweetuser();
			$allUsers =$tweetuser->gettweetuser($_GET['id']);
		}
   }
include('include/head.php');
include('include/sidebar.php');
?>
<div id="content" class="page-content clearfix">
<div class="contentwrapper">
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
			  <div class="heading">	
				<h3>Manage User</h3>
				
				
				<ul class="" style="float:right;">
					
					<li style="list-style:none">
						<a href="viewAlluser?TYPE=<?PHP ECHO $_GET['TYPE'] ; ?>&id=<?php echo $_GET['id'] ?>">View All Member</a>
						
					</li>
					
				</ul>
				<div style="clear:both"></div>
			</div>

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
											<th>Tweet</th>
											<th>Following</th>
											<th>Friend</th>
											<th>Favourite</th>
                                            <th>Action</th>
                                        </tr>
										</thead>
										<tbody>
					<?php
					$total=0;
					$i=0;
					foreach($allUsers as $k=>$userData){						
						$total+=$userData['friendcount'];
					
							if($userData['type']==1) continue; elseif($userData['type']==2) $type='dummy' ; else $type='Original' ?>

						<tr>
							<td><?php $i++; echo $i; ?></td>
							<td><?php echo $userData['firstname'] ?></td>
							<td><?php echo $userData['email']; ?></td>
							<td><?php echo $userData['tweetcount']; ?></td> 
							<td><?php echo $userData['friendcount']; ?></td> 
							<td><?php echo $userData['follower']; ?></td>
							<td><?php echo $userData['favourite']; ?></td> 
							
							<td>
								<a class="btn btn-danger" onclick="return confirm('Are you sure?');" href="<?php echo $config['SITE_URL']."userlist.php?TYPE=".$_GET['TYPE']."&id=".$_GET['id']."&delete=1&userId=".$userData['id'];?>">Delete</a>
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
</div>
</div>
<?php
include_once('include/footer.php');
?>
<script>
changenotificationstatus()
</script>
