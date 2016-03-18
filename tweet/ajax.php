<?php

$fileBasePath = dirname(__FILE__).'/';
include_once('include/actionHeader.php');
$main= new Main();
$userid=$_SESSION['user_info']['id'];
$user =new user();
$notification = new Notification();
$tweet= new twitter();
$group  = new Group();
$groupuser  = new groupuser();
$tweetergroup= new tweetergroup();
$tweetuser= new Tweetuser;
$notification = new Notification();
$groupuser  = new groupuser();
$interestedcat=new interestedcat();
$recommendtweetobj= new userrecommandtweet();
date_default_timezone_set("Asia/Kolkata");
//date_default_timezone_set($_SESSION['user_info']['default_timezone']);
if(!isset($_SESSION['user_info'])){
	exit();
}
/* Twitter Post */
if(isset($_POST['tweetid'])){
	$tweetid=$_POST['tweetid'];
	print_R($_POST);
	print_R($_FILES);
		$destination='';
		$tweet->tweettype	 = $_POST['tweettype'];
		if( $_POST['tweettype']=='0')
		{
			$tweet->tweet	 = $_POST['description'];
			if(isset($_FILES['tweet_image']) && !empty($_FILES['tweet_image']['name']))
			{
				$filename=$_FILES['tweet_image'];
				$source=$_FILES['tweet_image']['tmp_name'];
				$destination=rand().$_FILES['tweet_image']['name'];
					if(!empty($_POST['previmg'])){
						unlink($config['DOC_ROOT'].'/tweet_image/'.$_POST['previmg']);
					}
				if(move_uploaded_file($source,$config['DOC_ROOT'].'/tweet_image/'.$destination)){
					
				}
			}
			else{
				$destination=$_POST['previmg'];
			}

		}
		else{
			$tweet->tweet	 = $_POST['retweet'];
		}
			$tweet->id=$tweetid;
			$tweet->image=$destination;
			$tweet->datetime	 =  $_POST['datetime'];
			$tweet->timestamp	 =  strtotime($_POST['datetime']);
			$tweet->ownerid	 =  $_SESSION['user_info']['id'];
			$tweet->status	 = 0;
			$tweet->save();
			$lastid=  $tweetid;
			$_SESSION['msgsuccess'] = "Tweet Scheduled has been Updated successfully";
			$sql="delete from tweetergroup where tweetid='".$tweetid."'"	;	
			$main->runsql($sql);
			$sql="delete from tweetuser where tweetid='".$tweetid."'"	;	
			$main->runsql($sql);
			
			if(isset($_POST['allgroup']) && !empty($_POST['allgroup']))
			{
				foreach($_POST['allgroup'] as $key=>$value)
				{
					$tweetergroup->tweetid= $lastid;
					$tweetergroup->groupname= $value;
					$tweetergroup->create();
					$group  = new Group();
					$groupdetail=$group->findCustomRow(array('id'=>$value));
					$getuser=$groupuser->findgroupuser($value) ;
					$msg='';
					foreach($getuser as $key =>$user)
					{
							$tweetuser->tweetid=$lastid;
							$tweetuser->userid=$user['id'];
							$tweetuser->groupid=$value;
							$msg='<p>Hi '.$user['screen_name'].'</p>';
							if(!$user['group_notification'])
							{
								$tweetuser->status=0;
								$notification->notification=" Tweet Schedule Has been Updated by ".$groupdetail['title']. ' on '.$_POST['datetime']." Please update Statuss  ";
							
								$headers = 'From: AMPARM' . "\r\n".'reply-to: no-reply'. "\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$msg.='<p>Approval required for new tweet in '.$groupdetail['title']. '</p>';
								$msg.='<p>Regards <br/> '.website_name.'</p>';
								#mail($user['email'], 'New Tweet has been Scheduled' , $msg,$headers );		
							}
							else{
								$tweetuser->status=1;
								$notification->notification=" Tweet Schedule Has been Updated by by ".$groupdetail['title']. ' on '.$_POST['datetime'];
							}
							$tweetuser->create();
							$notification->userid=$user['id'];
							$notification->eventid=$lastid;
							$notification->type='Tweet';
							$notification->create();
							echo '1';
							
					}
				
				}
			}
			else{
				$tweetuser->tweetid=$lastid;
				$tweetuser->userid=$_SESSION['user_info']['id'];
				$tweetuser->groupid=0;
				$tweetuser->status=1;
				$tweetuser->create();
				echo '1';
							
			}
			if(isset($_REQUEST['feed']))
			{
				$feedid=$_REQUEST['feed'];
				$recommendtweetobj->userid=$_SESSION['user_info']['id'];
				$recommendtweetobj->blogid=$feedid;
				$recommendtweetobj->create();
			}
			
}
elseif(isset($_POST['tweettype'])){
	#print_R($_POST);
	#print_R($_FILES);
		$destination='';
		$tweet->tweettype	 = $_POST['tweettype'];
		if( $_POST['tweettype']=='0')
		{
			$tweet->tweet	 = $_POST['description'];
			if(isset($_FILES['tweet_image']) && !empty($_FILES['tweet_image']['name']))
			{
				$filename=$_FILES['tweet_image'];
				$source=$_FILES['tweet_image']['tmp_name'];
				$destination=rand().$_FILES['tweet_image']['name'];
				if(move_uploaded_file($source,$config['DOC_ROOT'].'/tweet_image/'.$destination)){
					
				}
				else{
				
				}
			}

		}
		else{
			$tweet->tweet	 = $_POST['retweet'];
		}
			$tweet->image=$destination;
			//$tweet->groupname	 = $_POST['group'];
			
			 $tweet->datetime	 =  $_POST['datetime'];
			 $tweet->timestamp	 =  strtotime($_POST['datetime']);
			//die;
			$tweet->ownerid	 =  $_SESSION['user_info']['id'];
			$tweet->status	 = 0;
			$tweet->create();
			$lastid=   $tweet->lastInsertId();
			$_SESSION['msgsuccess'] = "Tweet has been Scheduled successfully";  
			if(isset($_POST['allgroup']) && !empty($_POST['allgroup']))
			{
				foreach($_POST['allgroup'] as $key=>$value)
				{
					$tweetergroup->tweetid= $lastid;
					$tweetergroup->groupname= $value;
					$tweetergroup->create();
					$group  = new Group();
					$groupdetail=$group->findCustomRow(array('id'=>$value));
					$getuser=$groupuser->findgroupuser($value) ;
					$msg='';
					foreach($getuser as $key =>$user)
					{
							$tweetuser->tweetid=$lastid;
							$tweetuser->userid=$user['id'];
							$tweetuser->groupid=$value;
							$msg='<p>Hi '.$user['screen_name'].'</p>';
							if(!$user['group_notification'])
							{
								$tweetuser->status=0;
								$notification->notification="New Tweet Has been Scheduled by ".$groupdetail['title']. ' on '.$_POST['datetime']." Please update Statuss  ";
							
								$headers = 'From: AMPARM' . "\r\n".'reply-to: no-reply'. "\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
								$msg.='<p>Approval required for new tweet in '.$groupdetail['title']. '</p>';
								$msg.='<p>Regards <br/> '.website_name.'</p>';
								#mail($user['email'], 'New Tweet has been Scheduled' , $msg,$headers );		
							}
							else{
								$tweetuser->status=1;
								$notification->notification="New Tweet Has been Scheduled  by ".$groupdetail['title']. ' on '.$_POST['datetime'];
							}
							$tweetuser->create();
							$notification->userid=$user['id'];
							$notification->eventid=$lastid;
							$notification->type='Tweet';
							$notification->create();
							echo '1';
							
					}
				
				}
			}
			else{
				$tweetuser->tweetid=$lastid;
				$tweetuser->userid=$_SESSION['user_info']['id'];
				$tweetuser->groupid=0;
				$tweetuser->status=1;
				$tweetuser->create();
				echo '1';
							
			}
			if(isset($_REQUEST['feed']))
			{
				$feedid=$_REQUEST['feed'];
				$recommendtweetobj->userid=$_SESSION['user_info']['id'];
				$recommendtweetobj->blogid=$feedid;
				$recommendtweetobj->create();
			}
			
}

/* Twitter End Post */

if(isset($_GET['managegroup']))
{
	$managegroup=$_GET['managegroup'];
	$user->id=$userid;
	$_SESSION['user_info']['manage_group']=2;
	$user->manage_group=2;
	$user->save();
	$notification->notification=$_SESSION['user_info']['firstname']. " has sent you requset to approve Manage Group Options";
	$notification->userid=1;
	$notification->eventid=0;
	$notification->type='Group Request';
	$notification->create();
	
	
}

if(isset($_GET['defaulttimezone']))
{
	$user->id=$userid;
	$_SESSION['user_info']['default_timezone']=$_GET['defaulttimezone'];
	$user->default_timezone=$_GET['defaulttimezone'];
	$user->save();
}
if(isset($_POST['text']) && !empty($_POST['text']))
{
	include_once("inc/twitteroauth.php");
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$array=array_reverse(explode('/',$_POST["text"]));
	$my_update = $connection->get('statuses/show', array('id' => $array[0]));
	if(isset($my_update->id)){ ?>
		
		<div class="">
   
    <div class="row">
        <div class="col-md-12">
		<?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
            <img style='float:left;width:200px;height:200px; margin-right:10px;' src="<?php echo $my_update->entities->media[0]->media_url;?>" />
		<?php } ?>
            <p><?php echo utf8_decode($my_update->text) ;?></p>
        </div>
    </div>
	<?php	

	}
	
}
if(isset($_REQUEST['schedule']))
{
	$limit=$_REQUEST['limit'];
	if($_REQUEST['schedule'])
	{
		$allschduledtweet= $tweetuser->findschduledtweetuser($_SESSION['user_info']['id'],1,$limit );
		
	}
	else
	{
		$allschduledtweet= $tweetuser->findschduledtweetuser($_SESSION['user_info']['id'],0,$limit);
	}
	if(!empty($allschduledtweet)){ $i=0;
			foreach($allschduledtweet as $key=>$value) { $i++;
			$groupdetail=$group->findcustomRow(array('id'=>$value['groupid']));
															 
															
														if($value['tweettype']==0) {
															?>
                                                        <li>
														<?php if(isset($groupdetail['icon'])){ ?>
																<img  src="<?php echo 'img/'.$groupdetail['icon'] ?>"  alt=""class="twitter-widget-avatar">
														<?php }  else{ ?>
															<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
														<?php } ?>
                                                            <p class="tweet-text">
                                                                <?php echo $value['tweet'] ?><a href="#">...</a>
																<?php if($value['image']){?>
																 <img src="<?php echo $config['SITE_URL'].'/tweet_image/'.$value['image'] ?>" class="" width="100%" height="200">
																<?php } ?>
                                                            </p>
                                                           
                                                        
														<?php }else{
														$array=array_reverse(explode('/',$value["tweet"]));
														#print_R($array);
														$my_update =getretweetdetail($array[0]); 
														if(isset($my_update->id_str)){
														$retweet=$my_update->retweet_count;
														$loved=$my_update->favorite_count;
														}
														else continue;
														?>
															 <li>
															
														<?php if(isset($groupdetail['icon'])){ ?>
																<img  src="<?php echo 'img/'.$groupdetail['icon'] ?>"  alt=""class="twitter-widget-avatar">
														<?php }  else{ ?>
															<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
														<?php } ?>
															
                                                            <p class="tweet-text">
                                                                <?php echo utf8_decode($my_update->text) ;?><a href="#">...</a>
																 <?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
																	 <img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
																<?php } ?>
                                                            </p>
                                                           
                                                        
														<?php } ?>
														<div class="p15">
																<span class="twitter-widget-date">Schedule On : <?php echo date('d M Y h.i A ', strtotime($value['datetime'])) ?> <?php  if(!empty($groupdetail['title'])) echo  'By '. $groupdetail['title'] ; ?></span>
																<div class="pull-right">
																	<?php if(isset($retweet)){ ?>
																			<span class="pl10">
																			Retweet:<?php echo $retweet ;?>
																			Love: <?php echo $loved ;?>
																			</span>
																	<?php } ?>
																	<span class="pl10">
																		<a title="Allow Tweet" href="javascript:;" id='tweetallow_<?php echo $value['id'] ?>' style="<?php if($value['status']!='0'){?> display:none ;<?php } ?>" onclick='allow("<?php echo $value['id'] ?>","1")' >
																		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
																		</a>
																	</span>
																	<?php if(!$_REQUEST['schedule']) {?>
																			
																	<span class="pl10">
										
																		<a title="DisAllow Tweet" href="javascript:;" style="<?php if($value['status'] =='0'){ ?> display:none; <?php } ?>" id='tweetdisallow_<?php echo $value['id'] ?>' onclick='allow("<?php echo $value['id'] ?>","0")' >
																		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																		</a>
																	</span>
																	<?php } ?>

																	<!--<span class="pl10">
																		<a href="#">
																			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																		</a>
																	</span>-->															
																</div>
														</div>
														</li>
													
													<?php unset($retweet); unset($loved); } 
	}
}
if(isset($_POST['phone']))
{
	$user->id=$userid;
	$user->email=$_POST['email'];
	$user->firstname=$_POST['name'];
	$user->phone=$_POST['phone'];
	$user->save();
	$interestedcat->deleteCustom('userid',$userid);
	foreach($_POST['intcat'] as $key =>$value)
	{
		$interestedcat->userid=$userid;
		$interestedcat->catid=$value;
		$interestedcat->create();
	}
	
	echo 'Your Profile has been successfully Updated';
}

if(isset($_POST['groupid']))
{
	$id=$_POST['groupid'];
	$status=$_POST['curstatus'];
	$userid=$_SESSION['user_info']['id'];
	//$sql="update tweetuser set status='".$status."' where  userid='".$userid."' and tweetid='".$id."'";
	$sql="update groupuser set group_notification='".$status."' where  userid='".$userid."' and groupid='".$id."'";
	$main->runsql($sql);
	echo 1;
}
if(isset($_POST['group']))
{
	if(isset($_POST['userid']))
	{
		$groupuserid=$_POST['userid'];
	}
	$id=$_POST['group'];
	$sql="delete from tweetuser where groupid='".$id."' and  userid='".$groupuserid."'";
	$main->runsql($sql);
	$sql="delete from groupuser where groupid='".$id."' and  userid='".$groupuserid."'";
	$main->runsql($sql);
	echo 1;
}

if(isset($_POST['tweetacceptid']))
{
	$id=$_POST['tweetacceptid'];
	$status=$_POST['curstatus'];
	 $sql="update tweetuser set status='".$status."' where  userid='".$userid."' and tweetid='".$id."'";
	
	$main->runsql($sql);
	echo 1;
}
if(isset($_POST['notification']))
{
	$sql="update notification set status=1 where userid='".$userid."'";
	$main->runsql($sql);

}
if(isset($_POST['new_password'])){
	if($_SESSION['user_info']['password']==md5($_POST['current_password'])){
		$user->id		 = $_SESSION['user_info']['id'];
		$user->password	 = md5($_POST['new_password']);
		$user->save();
		$_SESSION['user_info']['password'] = md5($_POST['new_password']);
		$msgsuccess = "Password changed successfully";
		
	}
	else{
		$msgsuccess = "Enter valid current password";
	
	}
	
echo $msgsuccess;
	
	exit;
}
if(isset($_GET['paginate']))
{
	if($_GET['paginate']=='feed')
	{
		$page=$_GET['page'];
		$start=$page-1;
		$groupuser  = new groupuser();
		$CategoryUrl  =new CategoryUrl(); 
		$recommendtweetobj= new userrecommandtweet();
		
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
		 $sql.=" 1 order by total_count desc limit ". $start*10 .", 10";
		$blogfeed=$main->runsql($sql);
		foreach($blogfeed as $key=>$value){ ?>
			<li>
			   
				 <p class="tweet-text">
                     <span id='feed_<?php echo $value['id'] ?>'><?php echo $value['title'] ?> </span> <a href="<?php echo $value['shorturl'] ?>" target="_blank"><?php echo $value['shorturl'] ?></a>
					<button name="addtweetschedule" id="addtweetbutton" class="btn btn-xs btn-success pull-right" onclick="showschedulemodel('','<?php echo trim($value['shorturl']) ;?>','<?php echo $value['id'] ?>')" type="submit">Add</button>
					<br/>
					<span> via :<?php echo $value['source'] ?> 
					</span>
                 </p>
			</li>
		<?php }

	}
	if($_GET['paginate']=='alltweet')
	{
		$page=$_GET['page'];
		$start=$page*10;
		$sql=$tweet->gettwiiterbyownersql($_SESSION['user_info']['id'],$start);
		$alltweet=$main->runsql($sql);
		?>
		<?php
		foreach($alltweet as $k=>$value){
			
			$i=0;
			
														
				$totalcount=0;
				$estimatecoun=0;
					$result=$tweetergroup->findgroupdetail($value['id']);				
					$name='';
					foreach($result as $key=>$value2){
					$name.=$value2['title'].',';
					}	$i++;
					$strname=substr($name,0,-1);
					$total=$tweetuser->countWhere('userid','tweetid='.$value['id']);
					$count=$tweetuser->countWhere('userid','status=1 and tweetid='.$value['id']);
					$sql="select sum(u.follower) as reach from users u,tweetuser g where g.tweetid='".$value['id']."' and u.id=g.userid";
					$totalcount=$main->runsql($sql);
					
					$sql="select sum(u.follower) as reach from users u,tweetuser g where g.tweetid='".$value['id']."' and u.id=g.userid and g.status=1";
					$estimatecount=$main->runsql($sql);
					?>
				
				<?php
			
					if($value['tweettype']==0) {
						
				?> <div class="row">
						 <div class="col-md-2">
							
							<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
							
						 </div>
						 <div class="col-md-10">
						   <div class="tweet-text">
							<?php echo $value['tweet'] ?><a href="#">...</a>
						   </div>
						   <div class="tweetPost-thumb">
								<?php if(!empty($value['image'])) { ?>							   
									<img src="<?php echo $config['SITE_URL'].'/tweet_image/'.$value['image'] ?>" class="" width="100%">							   
								<?php } ?>
							</div>
						   <div class="tweet-action">
							<div class="action-button">
							  <!--<a href="#"><span class="glyphicon glyphicon-repeat"></span></a>-->
							    <a href="<?php echo $config['SITE_URL']."userlist.php?TYPE=TWEET&id=".$value['id'];?>"><span class="eco-users"></span></a>
							  <!--<a href="#"><span class="glyphicon glyphicon-heart"></span></a>
								   <a href="#"><span class="glyphicon glyphicon-retweet"></span></a>-->
							 </div>
							 <div class="reach">
							   <strong>Reach : <?php echo $totalcount[0]['reach'] ; ?></strong>
							    
							 </div>
							 <div class="amplified">
							   <?php if($value['status']){ ?><strong>Schedule On : </strong><?php } else{ ?>
							   <strong>Amplified On : </strong>
							   <?php } ?><?php echo date('d M Y h.i A', strtotime($value['datetime'])) ?>
							 </div>
						   </div><!---./tweet-action --->
						 </div>  
					   </div>
				<?php } else{ 
					$array=array_reverse(explode('/',$value["tweet"]));
					$my_update =getretweetdetail($array[0]); 
				?>
							<div class="row">
							 <div class="col-md-2">
									
									<img  src="<?php echo  $_SESSION['user_info']['profile_image_url'] ?>"  alt="<?php echo  $_SESSION['user_info']['screen_name'] ?>"class="twitter-widget-avatar">
									
							 </div>
							 <div class="col-md-10">
							   <div class="tweet-text">
								<?php echo utf8_decode($my_update->text) ;?><a href="#">...</a>
							   </div>
							   <div class="tweetPost-thumb">
								<?php if(!empty($my_update->entities->media[0]->media_url)){ ?>
									<img src="<?php echo $my_update->entities->media[0]->media_url;?>" class="" width="100%">
								<?php } ?>
							   </div>
							   <div class="tweet-action">
								<div class="action-button">
								   <!--<a href="#"><span class="glyphicon glyphicon-repeat"></span></a>-->
								  <a href="<?php echo $config['SITE_URL']."userlist.php?TYPE=TWEET&id=".$value['id'];?>"><span class="eco-users"></span></a>
								   <!--<a href="#"><span class="glyphicon glyphicon-retweet"></span></a>-->
								 </div>
								 <div class="reach">
								   <strong>Reach : <?php echo $totalcount[0]['reach'] ; ?></strong>
								 </div>
								 <div class="reach">
								 <div class="amplified">
								   <?php if($value['status']){ ?><strong>Schedule On : </strong><?php } else{ ?>
										<strong>Amplified On : </strong>
								   <?php } ?><?php echo date('d M Y h.i A', strtotime($value['datetime'])) ?>
							 </div>
								 </div>
							   </div><!---./tweet-action --->
							 </div>  
						   </div>
					
				<?php } ?><div>
						  <hr>
						
				</div>
		<?php }  ?>
		
		<?php
		
	}
}

if(isset($_REQUEST['tweetdetail']))
{
	$tweetid=$_REQUEST['tweetdetail'];
	$mytweet=array();
	$tweetdetail=$tweet->findCustomRow(array('id'=>	$tweetid));
	$mytweet['desc']=$tweetdetail['tweet'];
	$mytweet['feed']=0;
	$mytweet['tweettype']=$tweetdetail['tweettype'];
	$mytweet['datetime']=$tweetdetail['datetime'];
	$mytweet['image']=$tweetdetail['image'];
	if($tweetdetail['tweettype']==0)
	{
		preg_match_all('!http?://\S+!',$mytweet['desc'], $matches);
		$url = $matches[0];
		
		if(is_array($url) && !empty($url))
		{
			$sql="select * from urlblog where shorturl='".$url[0]."'";
			$blogfeed=$main->runsql($sql);
			if(count($blogfeed))
			{
				$mytweet['feed']=1;
			}
		}
	}
	else{		
		$array=array_reverse(explode('/',$tweetdetail["tweet"]));
		$my_update =getretweetdetail($array[0]);
		if(!empty($my_update->text)){
			$mytweet['retweetdesc']= utf8_decode($my_update->text); 
		}
		if(!empty($my_update->entities->media[0]->media_url)){ 
			$mytweet['retweetimg']=$my_update->entities->media[0]->media_url;
		}		
	}
	$sql="select groupname from tweetergroup where tweetid='".$tweetid."'";
	$groupdetail=$main->runsql($sql);
	if(!empty($groupdetail))
	{
		$mytweet['group']=$groupdetail;
	}
	echo  json_encode($mytweet);
}

if(isset($_POST['schedule-days']))
{
	$sql="delete from usertimesetting where userid='".$_SESSION['user_info']['id']."'";
	$main->runsql($sql);
	$usertimesettingobj= new usertimesetting();
	$scheduleday='';
	
	foreach($_POST['schedule-days']  as $key=>$value)
	{
		$scheduleday.=$value.',';
	}
	$scheduleday= substr($scheduleday,0,-1);
	$user->weekday=$scheduleday;
	$user->id=$userid;
	$_SESSION['user_info']['weekday']=$scheduleday;
	$user->save();
	foreach($_POST['hourday']  as $key=>$value)
	{
		$hour=$_POST['hourday'][$key];
		$min=$_POST['minute'][$key];
		$ampm=$_POST['ampm'][$key];
		if($ampm=='pm')
		{
			$hour=12+$hour;
			if($hour>23){
				$hour='00';
			}
		}
		$time=$hour.':'.$min.':00';
		$usertimesettingobj->userid=$userid;
		$usertimesettingobj->hour=$_POST['hourday'][$key];
		$usertimesettingobj->minute=$min;
		$usertimesettingobj->mornight=$ampm;
		$usertimesettingobj->actualtime=$time;
		$usertimesettingobj->create();
	}
}
