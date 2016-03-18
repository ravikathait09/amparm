<?php
$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once("inc/twitteroauth.php");
$user=new User();
if(!isset($_SESSION['user_info']['id'])){
	header('Location: logout.php');
	exit;
}

include('include/head.php');
include('include/sidebar.php');
$notificaction = new Notification();
$unreadnotification=$notificaction->findCustom(array('userid'=>$_SESSION['user_info']['id'],'status'=>0));
$allnotification=$notificaction->findCustom(array('userid'=>$_SESSION['user_info']['id']));

?>
<div id="content" class="page-content clearfix">
<div class="contentwrapper">
		
			<div class="col-md-12">
				<!-- profile information sidebar -->
				<div class="panel overflow-hidden no-b profile p15">
					<div class="row mb25 bb">
						<div class="col-sm-12">
							<div class="notifications dropdown">
								<a data-toggle="dropdown" href="javascript:;">
									<div class="badge badge-top bg-danger animated flash">
										<span><?php echo count($unreadnotification); ?></span>	Unread
									
									</div>
								</a>
								<div class="row-fluid">
									<?php if(!empty($allnotification)) { foreach($allnotification as $key =>$value){
									if($value['type']=='Group'){
										$url="userlist?TYPE=GROUP&id=".$value['eventid'] ;
									}
									else if($value['type']=='Group Request'){
										$url="managegroup";
									}
									else
									{
										$url="dashboard.php#history";
									}
									?>											  
										<div class="pl10 pt5 pr10 mb20 bt">
												<div class="mr15 ml5 mb10 mt5">
													<div class="circle-icon bg-default">
														<a href="<?php echo $url; ?>">
															<i class="ti-flag-alt"></i>
														</a>
													</div>
												</div>
												<div class="m-body">
													
													<div class="small">
														<div>
														<?php echo $value['notification'] ?>
														</div>		
													</div>
												</div>
											</div>
									<?php } } ?>											
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- /profile information sidebar -->
			</div>
		</div>
</div>

<?php include('include/footer.php'); ?>