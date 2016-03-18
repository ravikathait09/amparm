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
	header('Location: logout.php');
}
if($_SESSION['user_info']['manage_group']!=1){
	header('location:dashboard');
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
				<div class="resBtnSearch">
					<a href="#"><span class="s16 icomoon-icon-search-3"></span></a>
				</div>
				
				<ul class="breadcrumb">
					<li>You are here:</li>
					<li>
						<a href="#" class="tip" title="back to dashboard">
							<i class="s16 icomoon-icon-screen-2"></i>
						</a>
						<span class="divider">
								<i class="s16 icomoon-icon-arrow-right-3"></i>
						</span>
					</li>
					<li class="active">User Management</li>
				</ul>
			</div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                      
                            <!-- general form elements -->
                         
					<?php
					$total=0;
					foreach($allUsers as $k=>$userData){						
						$total+=$userData['friendcount'];
					
							if($userData['type']==1) continue; elseif($userData['type']==2) $type='dummy' ; else $type='Original' ?>

						  <div class="col-md-4">
						  
							<div class="panel panel-default">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">Profile details</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row profile">
                                        <!-- Start .row -->
                                       <div class="col-md-12">
                                         <div class="p10">
										  <div class="profile-avatar">
                                                <img class="center-block" src="<?php echo  $userData['profile_image_url'] ?>"  alt="<?php echo  $userData['screen_name'] ?>">
                                          </div>
										  </div> 
										</div>
                                        <div class="col-md-12">
										   <div class="p10">
                                            <div class="profile-name text-center">
                                                <h3><?php echo $userData['firstname'] ?></h3>
												
                                              
                                            </div>
											</div>
                                        </div>
										<div class="col-md-12">
										   <div class="twitter-widget">
											<div class="twitter-widget-header bt p20">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                        <!-- col-lg-4 start here -->
                                                        <a href="#">
                                                            <p class="twitter-widget-text">Tweets</p>
                                                            <strong class="twitter-widget-number"><?php echo $userData['tweetcount'];  ?></strong> 
                                                        </a>
                                                    </div>
													
                                                    <!-- col-lg-4 end here -->
                                                    <div class="col-lg-4 col-lg-4 col-md-4 col-sm-4 text-center">
                                                        <!-- col-lg-4 start here -->
                                                        <a href="#">
                                                            <p class="twitter-widget-text">Friend</p>
                                                            <strong class="twitter-widget-number"><?php echo $userData['follower'];  ?></strong> 
                                                        </a>
                                                    </div>
                                                    <!-- col-lg-4 end here -->
                                                    <div class="col-lg-4 col-lg-4 col-md-4 col-sm-4 text-center">
                                                        <!-- col-lg-4 start here -->
                                                        <a href="#">
                                                            <p class="twitter-widget-text">Following</p>
                                                            <strong class="twitter-widget-number"><?php  echo $userData['friendcount'];  ?></strong> 
                                                        </a>
                                                    </div>
                                                    <!-- col-lg-4 end here -->
                                                </div>
                                            </div>
										</div>
                                        <div class="col-md-12">
                                            <div class="contact-info bt">
                                                <div class="row">
                                                    <!-- Start .row -->
                                                    <div class="col-md-4">
                                                        <dl class="mt20">
                                                            <dt class="text-muted">Phone</dt>
                                                            <dd><?php echo $userData['phone'] ?></dd>
                                                          
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <dl class="mt20">
                                                            <dt class="text-muted">Email</dt>
                                                            <dd><?php echo $userData['email'] ?></dd>
                                                           
                                                           
                                                        </dl>
                                                    </div>
                                                </div>
                                                <!-- End .row -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="profile-info bt">
                                                <h5 class="text-muted">Twiiter Bio </h5>
                                                <p><?php echo $userData['descripition'] ;?>

												</p>
                                            </div>
                                         
                                          
                                        </div>
                                    </div>
                                    <!-- End .row -->
                                </div>
                            </div>

							
							                                                                                                  
						</div>                                                                                
						<?php
						
					}
					?>
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
