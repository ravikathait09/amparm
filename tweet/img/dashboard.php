<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/header.php');
include_once("inc/twitteroauth.php");

$user=new User();
if(!isset($_SESSION['user_info']['id'])){
	header('Location: logout.php');
	exit;
}

$limit=10;
$category = new Category();
 $allCategories = $category->all();
$main= new Main();
$Group  = new Group();
$userdetail=$user->findcustomrow(array('id'=>$_SESSION['user_info']['id'] ));
$interestedcat=new interestedcat();
$twiiter  = new Tweetuser();
$groupuser  = new groupuser();
$CategoryUrl  =new CategoryUrl(); 
$recommendtweetobj= new userrecommandtweet();
$usercatarray=array();
$interestedcategory=$interestedcat->findCustom(array('userid'=>$_SESSION['user_info']['id']));
$recommenedtweet=$recommendtweetobj->findCustom(array('userid'=>$_SESSION['user_info']['id']));
$str=array();
$nostr=array();
foreach($interestedcategory as $key =>$value)
{
	$usercatarray[]=$value['catid'];
	$allurl=$CategoryUrl->findcustom(array('catid'=>$value['catid']));
	foreach($allurl as $key=>$value)
	   {
		   $str[]=$value['id'];
	   }
}
foreach($recommenedtweet as $key =>$value)
{
	$nostr[]=$value['id'];
}
$blogfeed=array();
$sql="select * from urlblog where ";
if(!empty($str))
{
	$sql.="urlid in(".implode(',',$str).") and  ";
}
if(!empty($nostr))
{
	$sql.="id not in(".implode(',',$nostr).") and ";
}
$getttoal=$main->runsql($sql. ' 1');
 $totalfeed=count($getttoal);
 $sql.=" 1 order by id limit 10";
$blogfeed=$main->runsql($sql);

$allschduledtweet= $twiiter->findschduledtweetuser($_SESSION['user_info']['id'],0,$limit );
$allprevioustweet= $twiiter->findschduledtweetuser($_SESSION['user_info']['id'],1,$limit);

$allshedulesql=$twiiter->findschduledtweetusersql($_SESSION['user_info']['id'],0,$limit );
$allhistorysql=$twiiter->findschduledtweetusersql($_SESSION['user_info']['id'],1,$limit );

$allgroup=$Group->getgroupbyowner($_SESSION['user_info']['id']);
include('include/head.php');
include('include/sidebar.php');
 $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['user_info']['outh_token'] , $_SESSION['user_info']['oauth_token_secret']);
 #$twtterstream=$connection->get('statuses/user_timeline', array('screen_name' => $screenname, 'count' =>10));

 ?>
 <!-- End #right-sidebar -->
            <!--Body content-->
<div id="content" class="page-content clearfix">
<div class="contentwrapper">
	<!--Content wrapper-->
	<div class="heading">
		<!--  .heading-->
		<h3>Dashboard</h3>
		<div class="resBtnSearch">
			<a href="#"><span class="s16 icomoon-icon-search-3"></span></a>
		</div>
		
		<!--  /search -->
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
			<li class="active">Dashboard</li>
		</ul>
		
		<div class="alert alert-success alert-dismissable" style="<?php if(!isset($_SESSION['msgsuccess'])){ echo "display:none"; } ?>">
			<i class="fa fa-check"></i>
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
			<b>Alert!</b> <p id="successmsg"><?php if(isset($_SESSION['msgsuccess'])){ echo $_SESSION['msgsuccess'];  unset($_SESSION['msgsuccess']); } ?></p>
		</div>
	</div>
	<!-- End  / heading-->
	
	<div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <!-- col-lg-4 start here -->
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
                                                <img class="center-block" src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>">
                                          </div>
										  </div> 
										</div>
                                        <div class="col-md-12">
										   <div class="p10">
                                            <div class="profile-name text-center">
                                                <h3><?php echo $userdetail['firstname'] ?></h3>
												
                                              
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
                                                            <strong class="twitter-widget-number"><?php if($_SESSION['user_info']['tweetcount']<1000)echo $_SESSION['user_info']['tweetcount']; else echo round($_SESSION['user_info']['tweetcount']/1000,2).'K'  ?></strong> 
                                                        </a>
                                                    </div>
                                                    <!-- col-lg-4 end here -->
                                                    <div class="col-lg-4 col-lg-4 col-md-4 col-sm-4 text-center">
                                                        <!-- col-lg-4 start here -->
                                                        <a href="#">
                                                            <p class="twitter-widget-text">Following</p>
                                                            <strong class="twitter-widget-number"><?php if($_SESSION['user_info']['friendcount']<1000)echo $_SESSION['user_info']['friendcount'] ;else echo  round($_SESSION['user_info']['friendcount']/1000,2).'K' ?></strong> 
                                                        </a>
                                                    </div>
                                                    <!-- col-lg-4 end here -->
                                                    <div class="col-lg-4 col-lg-4 col-md-4 col-sm-4 text-center">
                                                        <!-- col-lg-4 start here -->
                                                        <a href="#">
                                                            <p class="twitter-widget-text">Followers</p>
                                                            <strong class="twitter-widget-number"><?php if($_SESSION['user_info']['follower']<1000)echo $_SESSION['user_info']['follower']; else echo round($_SESSION['user_info']['follower']/1000,2).'K' ?></strong> 
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
                                                            <dd><?php echo $userdetail['phone'] ?></dd>
                                                          
                                                        </dl>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <dl class="mt20">
                                                            <dt class="text-muted">Email</dt>
                                                            <dd><?php echo $userdetail['email'] ?></dd>
                                                           
                                                           
                                                        </dl>
                                                    </div>
                                                </div>
                                                <!-- End .row -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="profile-info bt">
                                                <h5 class="text-muted">Twiiter Bio </h5>
                                                <p><?php echo $userdetail['descripition'] ;?>

												</p>
                                            </div>
                                         
                                          
                                        </div>
                                    </div>
                                    <!-- End .row -->
                                </div>
                            </div>
                            <div class=""> 
							   <div class="stats-btn tipB mb20">
								<p class="p10">Young and full of running
								tell me where is that taking me?
								just a great figure eight
								or a tiny infinity?</p>
								<span class="notification">Tweet Of The Day</span> 
								</div>
							</div>
                        </div>
                        <!-- col-lg-4 end here -->
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <!-- col-lg-4 start here -->
                            <div class="tabs mb20">
                                <ul id="profileTab" class="nav nav-tabs">
									<li class="active">
									 <a href="#Schedule" data-toggle="tab"> Amplify </a>
                                    </li>
                                    <li>
									  <a href="#recommend" data-toggle="tab"> Recommend Tweet </a>
                                    </li>
									<li>
									   <a href="#newSchedule" data-toggle="tab"> Schedule Tweet </a>
                                    </li>
									<li>
									   <a href="#history" data-toggle="tab"> History </a>
                                    </li>
									
									
                                    <li class="">
                                        <a href="#edit-profile" data-toggle="tab">Edit</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                   
									 <div class="tab-pane fade " id="recommend">
                                        <h5>Recommend feed</h5>
											<div class="twitter-widget">
												<div class="twitter-widget-tweets">
                                                    <ul id="recommendfeedlist">
													<?php 
													
														
													foreach($blogfeed as $key=>$value){ ?>
                                                        <li>
                                                           
                                                            <p class="tweet-text">
                                                               <?php echo $value['title'] ?><a href="<?php echo $value['blogurl'] ?>" target="_blank">...</a>
                                                            <button name="addtweetschedule" id="addtweetbutton" class="btn btn-xs btn-success pull-right" onclick="showschedulemodel('<?php echo stripslashes(substr($value['title'],0,115) ) ?>','<?php echo trim($value['shorturl']) ;?>','<?php echo $value['id'] ?>')" type="submit">Add</button>
															<br/>
															<span> via :<?php echo $value['source'] ?> on <?php echo date("D, d M Y h.i A ", strtotime($value['publishdate'])); ?>
															</span>
                                                          
															</p>
                                                        </li>
													<?php }

													?>
													
                                                       
                                                    </ul>
													<p class="demo demo4_top"></p>
                                                </div>
											</div>
                                        
                                       
                                    </div>
									  <div class="tab-pane fade  " id="newSchedule">
                                        <h5>Schedule Tweet</h5>
											<div class="twitter-widget instagram-widget">
												<div class="twitter-widget-tweets">
                                                    <ul id="scheduleul">
													<?php $i=0; if(!empty($allschduledtweet)) { $i=0;
															foreach($allschduledtweet as $key=>$value) { $i++;
															 
															
														if($value['tweettype']==0) {
															?>
                                                        <li>
															<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
                                                            <p class="tweet-text">
                                                                <?php echo $value['tweet'] ?><a href="#">...</a>
																<?php if($value['image']){?>
																 <img src="<?php echo $config['SITE_URL'].'/tweet_image/'.$value['image'] ?>" class="" width="100%" height="200">
																<?php } ?>
                                                            </p>
                                                           
                                                        
														<?php }else{
														$array=array_reverse(explode('/',$value["tweet"]));
														$my_update =getretweetdetail($array[0]); 
														?>
														<li>
															
															<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
															
															
                                                            <p class="tweet-text">
                                                                <?php echo utf8_decode($my_update->text) ;?><a href="#">...</a>
																 <?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
																	 <img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
																<?php } ?>
                                                            </p>
                                                           
                                                        
														<?php } ?>
														<div class="p15">
																<span class="twitter-widget-date">Schedule On : <?php echo date('d-m-Y H : i :s ', strtotime($value['datetime'])) ?></span>
																<div class="pull-right">
																	<span class="pl10">
																		<a title="Allow Tweet" href="javascript:;" id='tweetallow_<?php echo $value['id'] ?>' style="<?php if($value['status']!='0'){?> display:none ;<?php } ?>" onclick='allow("<?php echo $value['id'] ?>","1")' >
																		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
																		</a>
																	</span>
																	<span class="pl10">
																		<a title="DisAllow Tweet" href="javascript:;" style="<?php if($value['status'] =='0'){ ?> display:none; <?php } ?>" id='tweetdisallow_<?php echo $value['id'] ?>' onclick='allow("<?php echo $value['id'] ?>","0")' >
																		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																		</a>
																	</span>
																	<!--<span class="pl10">
																		<a href="#">
																			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																		</a>
																	</span>-->															
																</div>
														</div>
														</li>
													
													<?php } }?>                                                       
                                                    </ul>													
													<?php if($i==$limit){?>
													<div class="col-lg-12 col-md-12 col-xs-12 text-center">
													<input type="hidden" id="schedulelimit" value="<?php echo $limit ?>"/>
														<button type="button" onclick='Load("schedule",this)' class="btn btn-info">LoadMore</button>
													</div>
													<?php } ?>
                                                </div>
											</div>
										</div>
										
									<div class="tab-pane fade " id="history">
                                        <h5> History</h5>
											<div class="twitter-widget instagram-widget">
												<div class="twitter-widget-tweets">
                                                    <ul id="historyul">
													<?php $i=0; if(!empty($allprevioustweet)) { 
															foreach($allprevioustweet as $key=>$value) {  $i++;
															#echo '<pre>'; print_R($value); echo '</pre>';
															$my_update =getretweetdetail($value['tweetreplyid']); 
															if(empty($value['tweetreplyid'])){
															if($value['tweettype']==0) {
															?>
																<li>
																	<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>" class="twitter-widget-avatar">
															
																	<p class="tweet-text">
																		<?php echo $value['tweet'] ?><a href="#">...</a>
																		<?php if($value['image']){?>
																		 <img src="<?php echo $config['SITE_URL'].'/tweet_image/'.$value['image'] ?>" class="" width="100%" height="200">
																		<?php } ?>
																	</p>
																   
																
															<?php }else{
																$array=array_reverse(explode('/',$value["tweet"]));
														
																$my_update =getretweetdetail($array[0]); 
																#echo '<pre>'; print_R($my_update); echo '</pre>';
															?>
																<li>														
																	<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>" class="twitter-widget-avatar">
																	<p class="tweet-text">
																		<?php echo utf8_decode($my_update->text) ;?><a href="#">...</a>
																		<?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
																			<img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
																		<?php } ?>
																	</p>											   
																
														<?php } 
														} else{ 	
														$my_update =getretweetdetail($value['tweetreplyid']);  
														#echo '<pre>'; print_R($my_update); echo '</pre>';
														?>
															 <li>										
																	<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>" class="twitter-widget-avatar">													
																	<p class="tweet-text">
																		<?php if(!empty($my_update->text)){ echo utf8_decode($my_update->text) ;?><a href="#">...</a>
																		<?php } ?>
																		 <?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
																			 <img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
																		<?php } ?>
																	</p>												   
															
																
														<?php 	}  ?>
														<div class="p15">
															<span class="twitter-widget-date">Schedule On : <?php echo date('d-m-Y H : i :s ', strtotime($value['datetime'])) ?>
															
															</span>
															<div class="pull-right">
																<span class="pl10">
																	<div class="action-button">
																		<a href="#"><span class="glyphicon glyphicon-repeat"></span></a>
																		<a href="#"><span class="glyphicon glyphicon-heart"></span></a>
																		<a href="#"><span class="glyphicon glyphicon-retweet"></span></a>
																	</div>
																</span>
																<span class="pl10">
																	<a title="Dis Allow Tweet" href="javascript:;" style="<?php if($value['status'] =='1'){ ?> display:none; <?php } ?>" id='tweetallow_<?php echo $value['id'] ?>' onclick='allow("<?php echo $value['id'] ?>","1")' >
																		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
																	</a>
																</span>
															</div>
														</div>
														</li>
														
														<?php } }?>
                                                       
                                                    </ul>
													<?php if($i==$limit){?>
													<div class="col-lg-12 col-md-12 col-xs-12 text-center">
													<input type="hidden" id="historylimit" value="<?php echo $limit ?>"/>
														<button type="button" onclick='Load("history",this)' class="btn btn-info">LoadMore</button>
													</div>
													<?php } ?>
                                                </div>
											</div>
                                        
                                       
                                    </div>
									<div class="tab-pane fade pb0 active in" id="Schedule">
                                        <form method="post"  id="addtweet" class="form-horizontal group-border stripped" role="form" enctype="multipart/form-data">
											
											<div class="form-group">
												
									
												<label class="col-lg-3 col-md-3 control-label">Tweet Type</label>
												<div class="col-lg-9 col-md-9">
													<div class="radio-custom radio-inline">
														<input type="radio" placeholder="" id="tweettype" name="tweettype" class=" required" value='1' onclick='hide()' checked><label for="radio5" >ReTweet
														</label>
													</div>
												  
													<div class="radio-custom radio-inline">
													  <input type="radio" placeholder="" id="tweettype" name="tweettype" class=" required" value='0' onclick='show()' >
														<label for="radio4">Tweet</label>
													</div>
													
												</div>
									
											
											</div>
											<div class="box-body tweet" style="display:none;">
												<div class="form-group">
													<label class="col-lg-2 col-md-3 control-label" for="">Tweet Description</label>
													<div class="col-lg-10 col-md-9">
														<textarea class="" id="description" name="description" rows="3" cols="70" maxlength='140'></textarea>    
														
													</div>
												</div>
												<div class='form-group tweetimage' >
													<label class="col-lg-2 col-md-3 control-label" for="">Tweet Image</label>
													<div class="col-lg-10 col-md-9">
														<input type="file" name="tweet_image" id="tweet_image"/>
													</div>                        
												</div>

											</div>
									<div class="box-body retweet" >
										<div class='form-group'>
											<label class="col-lg-2 col-md-3 control-label" for="">ReTweet Url</label>
											<div class="col-lg-10 col-md-9">
											  <input id="retweetinput" name="retweet"  class='form-control ' maxlength='140'>
											</div>
										</div>
										<div id='retweetdescription' class='form-group retweetdescription' >
											                      
										</div>
								

									</div><!-- /.box -->
									<div class="form-group">
									    <label class="col-lg-2 col-md-3 control-label" for="">Date Time</label>
										<div class="col-lg-10 col-md-9">
											<div class='input-group date' id='datetimepicker1'>
												<input type='text' placeholder="Date/time" id="mydatetime" name="datetime" class="form-control required"/>
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>
											

               
								<?php if(count($allgroup)) { ?>
										<div class="form-group">
											<label class="col-lg-2 col-md-3 control-label" for="">Select Group</label>
											<div class="col-lg-10 col-md-9">											
											 <?php foreach($allgroup as $key=>$value) { ?>
												 <div class="col-md-3">
														<label for="exampleInputEmail1"><?php echo $value['title']; ?></label>
														<input type="checkbox" placeholder="Enter Group Name" id="catName"  name='allgroup[]' value='<?php echo $value['id']; ?>' class="  selectall " >	
														
												  </div>										
											<?php } ?>
											</div>
										</div>
								<?php } ?>
                                          
                                            <div class="form-group">
                                                <div class="col-lg-9 col-lg-offset-3">
                                                    <BUTTON name="addtweetschedule" id="addtweetbutton" class="btn btn-primary" type="submit">Schedule Tweet</BUTTON>
                                                </div>
                                            </div>
                                            <!-- End .form-group  -->
                                        </form>
                                    </div>
                                    <div class="tab-pane fade pb0" id="edit-profile">
                                        <form class="form-horizontal group-border stripped" role="form" id="profile" >
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label" for="">Name</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control required" id="name" name="name" value="<?php echo $userdetail['firstname']; ?>">
                                                </div>
                                            </div>
                                            <!-- End .form-group  -->
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label" for="">Email</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control required email" id="email" name="email" value="<?php echo $userdetail['email']; ?>">
                                                </div>
                                            </div>
                                          
                                            <!-- End .form-group  -->
                                            <div class="form-group form-group-vertical">
                                                <label class="col-lg-3 control-label" for="">Phone </label>
                                                <div class="col-lg-9">
                                                    <input type="phone" class="form-control required" id="phone" name="phone" value="<?php echo $userdetail['phone']; ?>">
                                                  
                                                </div>
                                            </div>
											
											<?php if(count($allCategories )) { ?>
											<div class="form-group">
													<div class="col-md-3">
															<label class="pull-right" style="display:block;" for="exampleInputEmail1">Interested Category </label>
													</div>
													
												<?php foreach($allCategories as $key=>$value) { ?>
													 <div class="col-md-9">
															<label for="exampleInputEmail1"><?php echo $value['cat_name']; ?></label>
															<input type="checkbox" id="catName" <?php if(in_array($value['id'],$usercatarray)) { echo 'checked';}?> name='intcat[]' value='<?php echo $value['id']; ?>' class=" selectall " >	
															
													  </div>										
												<?php } ?>
											</div>
											<?php } ?>
											
                                            <!-- End .form-group  -->
                                            <div class="form-group">
                                                <div class="col-lg-9 col-lg-offset-3">
                                                    <button href="#"  id= "contact_us_btn" class="btn btn-primary" type="">Make change</button>
                                                </div>
                                            </div>
										 </form>
												 
										
                                            
										<form method="post" class="form-horizontal group-border stripped" role="form" id="chgPassForm" >
											
											<div class="form-group">
                                              
                                                    <label class="col-lg-3 control-label" for="">Current Password </label>
													<div class="col-lg-9">
														<input type="password" class="form-control required" id="current_password" name="current_password" >
													  
													</div>
                                               
                                            </div>
											<div class="form-group">
                                               
                                                    <label class="col-lg-3 control-label" for="">New Password </label>
													<div class="col-lg-9">
														<input type="password" class="form-control required" id="new_password" name="new_password" >
													  
													</div>
                                               
                                            </div>
											<div class="form-group">
                                                
                                                    <label class="col-lg-3 control-label" for="">Confirm Password </label>
													<div class="col-lg-9">
														<input type="password" class="form-control required" id="confirm_password" name="confirm_password" >
													  
													</div>
                                                
                                            </div>
											
											  <div class="form-group">
                                                <div class="col-lg-9 col-lg-offset-3">
                                                    <button   id= "changepass" class="btn btn-primary" type="submit">change Password</button>
                                                </div>
                                            </div>
                                          
                                        </form> 
                                    </div>
                                </div>
                            </div>
                            <!-- End .tabs -->
                        </div>
                        <!-- col-lg-4 end here -->
                        
                        <!-- col-lg-4 end here -->
                    </div>
	<!-- / .row -->
</div>
<!-- End contentwrapper -->
</div> 

<?php include('include/footer.php'); ?>
<script src="js/bootpage.js"></script>
<script type="text/javascript">
$(function () {
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
	$('#datetimepicker1').datetimepicker({
		
		 format: 'YYYY-MM-DD HH:mm',
		 minDate: new Date() 
		
		 
		
	});
	 $('#datetimepicker3').datetimepicker({
		
		  format: 'YYYY-MM-DD HH:mm',
		 minDate: new Date() 
		
		 
		
	});
});

$('#retweetinput').blur(function(){
	myid=$('#retweetinput').val();
	if(myid){
		$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {text:myid},
		success:function(res){	
			if(res){
				$('#retweetdescription').html(res);
			}
		else{
				$('#retweetinput').val('');
				alert("Please enter Valid Tweet Url");
			}
		}
		});
	}
}); 
	function show()
	{
		$('.tweet').show();
		$('.retweet').hide();
		$('#description').addClass('required');
			$('#retweetinput').removeClass('required');
	}
	function hide()
	{
		$('.tweet').hide();
		$('.retweet').show();
		$('#description').removeClass('required');
		$('#retweetinput').addClass('required');
	}
</script>
<script>
jQuery('#profile').submit(function(event){
event.preventDefault();
if($('#profile').valid()){
	$('#contact_us_btn').text('Please Wait..');
	data =$('#profile').serialize();;
	$.ajax({
	type:'post',
		url:'ajax.php',
		data:  data,
		success:function(res){	
		$('#contact_us_btn').text('SUBMIT');
		
		alert(res);
				window.location();
			
		}
	});
}});
function allow(tweetid,status)
{
	$.ajax({
	type:'post',
		url:'ajax.php',
		data:  {'tweetacceptid':tweetid,'curstatus':status},
		success:function(res){	
		
			if(status=='1')
			{
				
				$('#tweetdisallow_'+tweetid).show();
				$('#tweetallow_'+tweetid).hide();
			}else{
				
				$('#tweetallow_'+tweetid).show();
				$('#tweetdisallow_'+tweetid).hide();
			}
			
		}
	});
}
function autotweet(id,status)
{
	$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {groupid:id,curstatus:status},
		success:function(res){	

			$('#description').val(res);
		}
	});
	
}
function removegroup(id)
{
		$.ajax({
		type:'post',
		url:'ajax.php',
		data:  {group:id,},
		success:function(res){	

			$('#group-'+id).remove();
		}
	});
}

</script>
<script>
jQuery('#chgPassForm').submit(function(event){
	event.preventDefault();
if($('#chgPassForm').valid()){
	$('#changepass').text('Please Wait..');
	data =$('#chgPassForm').serialize();;
	$.ajax({
	type:'post',
		url:'ajax.php',
		data:  data,
		success:function(res){	
		$('#changepass').text('Change Password');
		alert(res);
		}
	});
}});
jQuery('#addtweet').submit(function(event){
	event.preventDefault();
if($('#addtweet').valid()){
	$('#addtweetbutton').text('Please Wait..');

	var formData = new FormData($('#addtweet')[0]);
	
    $.ajax({
		type:'post',
		url:'ajax.php',
		data:  formData,
		 cache: false,
		  contentType: false,
		  processData: false,
		success:function(res){	
		$('#addtweetbutton').text('Schedule Tweet');
			alert("Tweet has been Scheduled");
		}
	});
	
}});

jQuery(document).on('click','#addrectweetbutton',function(){
	
if($('#addfeed').valid()){
	$('#addrectweetbutton').text('Please Wait..');
	var formData = $('#addfeed').serialize();
    $.ajax({
		type:'post',
		url:'ajax.php',
		data:  formData,		
		success:function(res){	
		$('#addrectweetbutton').text('Schedule Tweet');
		alert("feed Tweet has been Scheduled");
		$('#recommendscheduletweet').modal('hide');
		}
	});
}});

$("#chgPassForm").validate({
		rules : {
                new_password : {
                    minlength : 5
                },
                confirm_password : {
                    minlength : 5,
                    equalTo : "#new_password"
                }
		},
		
	});

	
function Load(reqtype,obj)
{
	if(reqtype=='history')
	{
		limit=parseInt($('#historylimit').val()) +parseInt(<?php echo $limit ;?>);
		schedule=1;
	}
	else if(reqtype=='schedule'){
		limit=parseInt($('#schedulelimit').val())+parseInt(<?php echo $limit ;?>);
		schedule=0;
	}
	$.ajax({
		type:'post',
		url:'ajax.php?schedule='+schedule+'&limit='+limit,
	
		success:function(res){	
			if(reqtype=='history'){
				$('#historylimit').val(limit);
				if(res){
				$('#historyul').append(res);
				}else{
					obj.remove();
				}
			}
			
			else{
					$('#schedulelimitlimit').val(limit);
					if(res){
				$('#scheduleul').append(res);
				}else{
					obj.remove();
				}
			}
				
		}
});
}
function showschedulemodel(desc,url,id){
	$('#recommendtweetdescription').val(desc+" : "+url);
	$('#feed').val(id);
	$('#recommendscheduletweet').modal('show');
}
jQuery(document).ready(function(){
jQuery('.demo4_top').bootpag({
        total: '<?php echo ceil($totalfeed/10); ?>',
        page: 1,
        maxVisible: 3,
        leaps: true,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event, num){
		$.ajax({
		type:'post',
		
		url:'ajax.php?paginate=feed&page='+num,
		success:function(res){	
			$("#recommendfeedlist").html(res); 
		
		}
		
        
    }); 
});
});
</script>
<div class="modal fade modal-style5" id="recommendscheduletweet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
			<h4 class="modal-title" id="mySmallModalLabel">Schedule Recommend Tweet</h4>
			</div>
			<form method="post"  id="addfeed" class="form-horizontal group-border stripped" role="form" enctype="multipart/form-data">
			
			<div class="modal-body ">
				<div class='form-group' >
					<input type="hidden" placeholder="" id="tweettype" name="tweettype" class=" required" value='0'  >
					<input type="hidden" placeholder="" id="feed" name="feed" class=" required" value='0'>
					<label for="exampleInputEmail1">Tweet Description</label><br >
					<textarea id="recommendtweetdescription"  name="description" rows="3" cols="70" maxlength='140'></textarea>
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Date Time</label>
					<div class='input-group date' id='datetimepicker3'>
						<input type='text' placeholder="Date/time" id="mydatetime" name="datetime" class="form-control required"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>	
				<div class="form-group">
					<div class="text-center">
						<BUTTON  type="button" name="addtweet" id="addrectweetbutton" class="btn btn-primary" >Schedule Tweet</BUTTON>
					</div>
				</div>	
			</div>
			
			
			
			</form>
</div>
</div>
</div>